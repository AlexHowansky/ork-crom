<?php

namespace Ork\Crom\Tests\Unit\Assertion;

use Doctrine\DBAL\DriverManager;
use Generator;
use Ork\Crom\Assertion\AbstractNameMatchesCaseAssertion;
use Ork\Crom\Assertion\AbstractNameMatchesRegexAssertion;
use Ork\Crom\Assertion\AssertionInterface;
use Ork\Crom\Assertion\AssertionException;
use Ork\Crom\Asset\AssetInterface;
use Ork\Crom\Scanner\AbstractScanner;
use Ork\Crom\Progress\SilentProgress;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use ReflectionClass;
use RuntimeException;
use TypeError;

abstract class AbstractAssertionTestCase extends TestCase
{

    protected function getAssertion(array $config = []): AssertionInterface
    {
        if (preg_match('/^(.+)Test$/', (new ReflectionClass($this))->getShortName(), $match) !== 1) {
            throw new RuntimeException('Unable to determine assertion class for test.');
        }
        $assertionClass = sprintf(
            '%s\%s\%s',
            (new ReflectionClass(AssertionInterface::class))->getNamespaceName(),
            basename(str_replace('\\', '/', (new ReflectionClass($this))->getNamespaceName())),
            $match[1]
        );
        if (class_exists($assertionClass) === false) {
            throw new RuntimeException('Missing expected assertion class: ' . $assertionClass);
        }
        $mockScanner = $this->getMockForAbstractClass(
            AbstractScanner::class,
            [
                [],
                new SilentProgress(),
                new NullLogger(),
                DriverManager::getConnection(['driver' => 'pdo_sqlite'])->createSchemaManager(),
            ]
        );
        return new $assertionClass($config);
    }

    abstract public static function providerForBadType(): Generator;

    abstract public static function providerForFail(): Generator;

    abstract public static function providerForPass(): Generator;

    public static function providerForRequiredParametersMissing(): Generator
    {
        yield [null, null, null];
    }

    /**
     * @dataProvider providerForBadType
     */
    public function testBadType(AssetInterface $asset): void
    {
        $assertion = $this->getAssertion();
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage(
            sprintf('Assertion "%s" does not support asset type "%s"', $assertion->getName(), $asset->getType())
        );
        $assertion($asset);
    }

    /**
     * @dataProvider providerForFail
     */
    public function testFail(AssetInterface $asset, array $config = []): void
    {
        $assertion = $this->getAssertion($config);
        try {
            $assertion($asset);
            $this->fail(sprintf('Value "%s" passed assertion but should not have.', $asset->getName()));
        } catch (AssertionException $e) {
            $this->assertSame($asset, $e->getAsset());
            $this->assertSame($assertion, $e->getAssertion());
        }

        $config['invert'] = true;
        $assertion = $this->getAssertion($config);
        try {
            $assertion($asset);
            $this->assertTrue(true);
        } catch (AssertionException $e) {
            $this->fail(sprintf('Value "%s" failed inverted assertion but should not have.', $asset->getName()));
        }
    }

    /**
     * @dataProvider providerForPass
     */
    public function testLabel(AssetInterface $asset, array $config = []): void
    {
        $assertion = $this->getAssertion($config);
        $this->assertStringContainsString($assertion->getName(), $assertion->getLabel());
        if ($assertion instanceof AbstractNameMatchesCaseAssertion === true) {
            $this->assertStringContainsString($config['strategy'], $assertion->getLabel());
        }
        if ($assertion instanceof AbstractNameMatchesRegexAssertion === true) {
            $this->assertStringContainsString($config['pattern'], $assertion->getLabel());
        }
    }

    /**
     * @dataProvider providerForPass
     */
    public function testPass(AssetInterface $asset, array $config = []): void
    {
        $assertion = $this->getAssertion($config);
        try {
            $assertion($asset);
            $this->assertTrue(true);
        } catch (AssertionException) {
            $this->fail(sprintf('Value "%s" failed assertion but should not have.', $asset->getName()));
        }

        $config['invert'] = true;
        $assertion = $this->getAssertion($config);
        try {
            $assertion($asset);
            $this->fail(sprintf('Value "%s" passed inverted assertion but should not have.', $asset->getName()));
        } catch (AssertionException $e) {
            $this->assertSame($asset, $e->getAsset());
            $this->assertSame($assertion, $e->getAssertion());
        }
    }

    /**
     * @dataProvider providerForRequiredParametersMissing
     */
    public function testRequiredParametersMissing(
        ?AssetInterface $asset,
        ?string $parameterName,
        ?array $config = []
    ): void {
        if ($asset === null) {
            $this->assertTrue(true);
            return;
        }
        $assertion = $this->getAssertion($config);
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(
            sprintf(
                'Assertion "%s" requires parameter "%s"',
                $assertion->getName(),
                $parameterName
            )
        );
        $assertion($asset);
    }

}
