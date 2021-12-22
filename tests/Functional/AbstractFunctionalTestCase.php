<?php

namespace Ork\Crom\Tests\Functional;

use Doctrine\DBAL\Platforms\OraclePlatform;
use Doctrine\DBAL\Platforms\PostgreSQLPlatform;
use Exception;
use Monolog\Handler\TestHandler;
use Ork\Crom\Scan;
use Ork\Crom\Scanner\AbstractScanner;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use RuntimeException;

abstract class AbstractFunctionalTestCase extends TestCase
{

    protected Scan $scan;

    /**
     * Some platforms force asset names to uppercase, some force to lowercase,
     * some leave as is.
     */
    protected function case(string $assetName): string
    {
        $platform = $this->scan->getConnection()->getDatabasePlatform();
        return match (true) {
            $platform instanceof OraclePlatform => strtoupper($assetName),
            $platform instanceof PostgreSQLPlatform => strtolower($assetName),
            default => $assetName,
        };
    }

    /**
     * Some databases don't support multiple statements in a single execution,
     * so we'll split on empty lines and execute each individually.
     */
    protected function executeStatement(string $statement): void
    {
        foreach (preg_split('/\n\n+/', $statement) as $statement) {
            $this->scan->getConnection()->executeStatement($this->platformify($statement));
        }
    }

    protected function getDatabaseConfig(): string
    {
        $file = sprintf('%s/db.yaml', dirname((new ReflectionClass($this))->getFileName()));
        if (file_exists($file) === false) {
            throw new RuntimeException(sprintf('Missing required database config file %s', $file));
        }
        return $file;
    }

    protected function getSchemaDirs(): array
    {
        return [
            dirname((new ReflectionClass($this))->getFileName()),
            __DIR__,
        ];
    }

    protected function getSchemaFile(string $pattern): ?string
    {
        foreach ($this->getSchemaDirs() as $schemaDir) {
            $file = sprintf(
                $pattern,
                $schemaDir,
                (new ReflectionClass($this))->getShortName(),
                $this->getName(false)
            );
            if (file_exists($file) === true) {
                return file_get_contents($file);
            }
        }
        return null;
    }

    protected function getSetupSchema(): string
    {
        return $this->getSchemaFile('%s/schema/%s/%s.sql')
            ?? throw new RuntimeException(sprintf('Missing required setup schema file'));
    }

    protected function getTeardownSchema(): string
    {
        return $this->getSchemaFile('%s/schema/%s/%s.clean.sql')
            ?? throw new RuntimeException(sprintf('Missing required teardown schema file'));
    }

    protected function getTestConfig(): string
    {
        $file = sprintf(
            '%s/config/%s/%s.yaml',
            __DIR__,
            (new ReflectionClass($this))->getShortName(),
            $this->getName(false)
        );
        if (file_exists($file) === false) {
            throw new RuntimeException(sprintf('Missing required test config file %s', $file));
        }
        return $file;
    }

    /**
     * We'll intercept `DROP TABLE` statements here and adjust them for Oracle
     * because there's no `IF EXISTS` clause on that platform.
     */
    protected function platformify(string $sql): string
    {
        if (
            $this->scan->getConnection()->getDatabasePlatform() instanceof OraclePlatform === true &&
            preg_match('/^DROP\s+TABLE\s+IF\s+EXISTS\s+(.+)$/', $sql, $match) === 1
        ) {
            return sprintf("BEGIN EXECUTE IMMEDIATE 'DROP TABLE %s'; EXCEPTION WHEN OTHERS THEN NULL; END;", $match[1]);
        }
        return $sql;
    }

    public function setUp(): void
    {
        $this->scan = (new Scan())
            ->mergeConfig($this->getDatabaseConfig())
            ->mergeConfig($this->getTestConfig());
        $this->executeStatement($this->getTeardownSchema());
        $this->executeStatement($this->getSetupSchema());
    }

    public function tearDown(): void
    {
        $this->executeStatement($this->getTeardownSchema());
    }

    protected function test(array $tests): void
    {
        $log = new TestHandler();
        $this->scan->pushHandler($log);
        ($this->scan)();
        $assertionName = lcfirst(preg_replace('/^test/', '', $this->getName(false)));
        foreach ($tests as [$scannerLabel, $assetName, $shouldPass]) {
            $this->assertTrue(
                $log->hasRecordThatPasses(
                    function (array $record) use ($scannerLabel, $assetName, $assertionName) {
                        $assetName = $this->case($assetName);
                        return $record['context']['scanner']->getLabel() === $scannerLabel &&
                            $record['context']['asset']->getName() === $assetName &&
                            $record['context']['assertion']->getName() === $assertionName;
                    },
                    $shouldPass === true ? AbstractScanner::LOG_LEVEL_PASS : AbstractScanner::LOG_LEVEL_FAIL
                ),
                sprintf(
                    "Unable to find log record matching:\n  scanner: %s\n  asset: %s\n  assertion: %s\n  should pass: %s\n",
                    $scannerLabel,
                    $assetName,
                    $assertionName,
                    $shouldPass ? 'yes' : 'no'
                )
            );
        }
    }

}
