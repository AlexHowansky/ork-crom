<?php

namespace Ork\Crom\Tests\Unit\Scanner;

use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Doctrine\DBAL\DriverManager;
use Ork\Crom\Progress\SilentProgress;
use Ork\Crom\Scanner\ScannerInterface;
use Ork\Crom\Tests\Unit\AbstractUnitTestCase;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

abstract class AbstractScannerTestCase extends AbstractUnitTestCase
{

    abstract protected function getScanner(
        SilentProgress $progress,
        LoggerInterface $logger,
        AbstractSchemaManager $schemaManager
    ): ScannerInterface;

    public function testConstructor(): void
    {
        $progress = new SilentProgress();
        $logger = new NullLogger();
        $schemaManager = DriverManager::getConnection(['driver' => 'pdo_sqlite'])->createSchemaManager();
        $scanner = $this->getScanner($progress, $logger, $schemaManager);
        $this->assertSame($progress, $scanner->getProgress());
        $this->assertSame($logger, $scanner->getLogger());
        $this->assertSame($schemaManager, $scanner->getSchemaManager());
        $this->assertSame(
            strtolower(preg_replace('/Scanner$/', '', (new \ReflectionClass($scanner))->getShortName())),
            $scanner->getName()
        );
    }

}
