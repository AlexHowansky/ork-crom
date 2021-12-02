<?php

namespace Ork\Crom\Tests\Unit\Scanner;

use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Ork\Crom\Progress\SilentProgress;
use Ork\Crom\Scanner\ScannerInterface;
use Ork\Crom\Scanner\TableScanner;
use Psr\Log\LoggerInterface;

class TableScannerTest extends AbstractScannerTestCase
{

    protected function getScanner(
        SilentProgress $progress,
        LoggerInterface $logger,
        AbstractSchemaManager $schemaManager
    ): ScannerInterface {
        return new TableScanner([], $progress, $logger, $schemaManager);
    }

}
