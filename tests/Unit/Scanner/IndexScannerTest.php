<?php

namespace Ork\Crom\Tests\Unit\Scanner;

use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Ork\Crom\Progress\SilentProgress;
use Ork\Crom\Scanner\IndexScanner;
use Ork\Crom\Scanner\ScannerInterface;
use Psr\Log\LoggerInterface;

class IndexScannerTest extends AbstractScannerTestCase
{

    protected function getScanner(
        SilentProgress $progress,
        LoggerInterface $logger,
        AbstractSchemaManager $schemaManager
    ): ScannerInterface {
        return new IndexScanner([], $progress, $logger, $schemaManager);
    }

}
