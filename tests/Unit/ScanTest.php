<?php

namespace Ork\Crom\Tests\Unit;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Platforms\SqlitePlatform;
use Monolog\Handler\TestHandler;
use Ork\Crom\Scan;
use RuntimeException;

class ScanTest extends AbstractUnitTestCase
{

    public function testConfigFileDoesNotExist(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unable to read configuration file');
        new Scan(__DIR__ . '/configFileThatDoesNotExist.json');
    }

    public function testConfigFileTypeUnrecognized(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unknown configuration file type');
        new Scan(__FILE__);
    }

    public function testConfigLoadJson(): void
    {
        $this->assertNotEmpty($this->scan->getConfig('database'));
    }

    public function testConfigLoadYaml(): void
    {
        $this->assertNotEmpty($this->scan->getConfig('database'));
    }

    public function testConfigSectionDoesNotExist(): void
    {
        $this->assertSame([], $this->scan->getConfig('sectionThatDoesNotExist'));
    }

    public function testExternalScanner(): void
    {
        $this->assertSame(0, ($this->scan)());
    }

    public function testGetConnection(): void
    {
        $this->assertInstanceOf(Connection::class, $this->scan->getConnection());
        $this->assertInstanceOf(SqlitePlatform::class, $this->scan->getConnection()->getDatabasePlatform());
    }

    public function testInclude(): void
    {
        $handler = new TestHandler();
        $this->scan->pushHandler($handler);
        $this->scan->getConnection()->executeStatement('CREATE TABLE foo (id INT)');
        $this->scan->getConnection()->executeStatement('CREATE TABLE bar (id INT)');
        $this->assertSame(0, ($this->scan)());
        $this->assertTrue($handler->hasInfoThatContains('scanning table asset "foo"'));
        $this->assertFalse($handler->hasInfoThatContains('scanning table asset "bar"'));
    }

    public function testMergeConfig(): void
    {
        $this->scan->mergeConfig($this->getConfigFile('json'));
        $this->assertSame('verbose', $this->scan->getConfig('progress'));
        $this->assertIsArray($this->scan->getConfig('database'));
        $this->assertNotEmpty($this->scan->getConfig('database'));
        $this->assertIsArray($this->scan->getConfig('scanners'));
        $this->assertNotEmpty($this->scan->getConfig('scanners'));
    }

    public function testMergeConfigDoesNotExist(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unable to read configuration file');
        $this->scan->mergeConfig(__DIR__ . '/configFileThatDoesNotExist.json');
    }

    public function testMergeConfigTypeUnrecognized(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unknown configuration file type');
        $this->scan->mergeConfig(__FILE__);
    }

    public function testMissingAssertion(): void
    {
        $this->scan->getConnection()->executeStatement('CREATE TABLE foo (id INT)');
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Configuration is missing assertion');
        $this->assertSame(1, ($this->scan)());
    }

    public function testNoLogHandler(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Configuration is missing log handler');
        $this->assertSame(1, ($this->scan)());
    }

    public function testNoScannerName(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Configuration is missing scanner name');
        $this->assertSame(1, ($this->scan)());
    }

    public function testNoScanners(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Configuration has no scanners');
        $this->assertSame(1, ($this->scan)());
    }

    public function testPushHandler(): void
    {
        $handler = new TestHandler();
        $this->assertSame(0, ($this->scan->pushHandler($handler))());
        $this->assertTrue($handler->hasInfoThatContains('launching table scanner'));
    }

    public function testScannerHasNoAssertions(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Configuration for scanner "foo" has no assertions');
        $this->assertSame(1, ($this->scan)());
    }

    public function testUnknownAssertionForScanner(): void
    {
        $this->scan->getConnection()->executeStatement('CREATE TABLE foo (id INT)');
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(
            'Configuration refers to unknown assertion "columnNameMatchesCase" for scanner "table"'
        );
        $this->assertSame(1, ($this->scan)());
    }

    public function testUnknownLogHandler(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Configuration references unknown log handler "foo"');
        $this->assertSame(1, ($this->scan)());
    }

    public function testUnknownProgress(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Configuration references unknown progress "foo"');
        $this->assertSame(1, ($this->scan)());
    }

    public function testUnknownScanner(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Configuration references unknown scanner "foo"');
        $this->assertSame(1, ($this->scan)());
    }

}
