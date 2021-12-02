<?php

namespace Ork\Crom\Tests\Functional;

use Monolog\Handler\TestHandler;
use Ork\Crom\Scan;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use RuntimeException;

abstract class AbstractFunctionalTestCase extends TestCase
{

    protected Scan $scan;

    /**
     * SQLServer is strange -- it does not allow more than one schema to be
     * created in a single statement. Multiples can be dropped, but only one
     * created. If we encounter this situation, we'll split the string into
     * separate statements and execute each individually.
     */
    protected function executeStatement(string $statement): void
    {
        $conn = $this->scan->getConnection();
        if (
            stripos($statement, 'CREATE SCHEMA') !== false &&
            $conn->getDatabasePlatform()->getName() === 'mssql'
        ) {
            $statements = preg_split('/;\n+/', trim($statement, ";\n"));
        } else {
            $statements = [$statement];
        }
        foreach ($statements as $statement) {
            $conn->executeStatement($statement);
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
        foreach ($tests as [$scannerLabel, $assetName, $level]) {
            $this->assertTrue(
                $log->hasRecordThatPasses(
                    function (array $record) use ($scannerLabel, $assetName, $assertionName) {
                        return $record['context']['scanner']->getLabel() === $scannerLabel &&
                            $record['context']['asset']->getName() === $assetName &&
                            $record['context']['assertion']->getName() === $assertionName;
                    },
                    $level
                ),
                sprintf(
                    "Unable to find log record matching:\n\nscanner: %s\nasset: %s\nassertion: %s\nlevel: %s\n",
                    $scannerLabel,
                    $assetName,
                    $assertionName,
                    $level
                )
            );
        }
    }

}
