<?php

namespace Ork\Crom\Tests\Unit\Scanner;

use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Ork\Crom\Progress\SilentProgress;
use Ork\Crom\Scanner\ColumnScanner;
use Ork\Crom\Scanner\ScannerInterface;
use Psr\Log\LoggerInterface;

class ColumnScannerTest extends AbstractScannerTestCase
{

    protected function getScanner(
        SilentProgress $progress,
        LoggerInterface $logger,
        AbstractSchemaManager $schemaManager
    ): ScannerInterface {
        return new ColumnScanner([], $progress, $logger, $schemaManager);
    }

}
