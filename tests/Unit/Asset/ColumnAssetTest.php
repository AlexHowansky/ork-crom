<?php

namespace Ork\Crom\Tests\Unit\Asset;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\StringType;
use Ork\Crom\Asset\ColumnAsset;
use PHPUnit\Framework\TestCase;

class ColumnAssetTest extends TestCase
{

    public function testAsset(): void
    {
        $tableName = md5(random_bytes(32));
        $columnName = md5(random_bytes(32));
        $column = new Column($columnName, new StringType());
        $table = new Table($tableName, [$column]);
        $asset = new ColumnAsset($table, $column);
        $this->assertSame($column, $table->getColumn($columnName));
        $this->assertSame(sprintf('%s.%s', $tableName, $columnName), $asset->getLabel());
        $this->assertSame($columnName, $asset->getName());
        $this->assertSame($column, $asset->getColumn());
        $this->assertSame($table, $asset->getTable());
        $this->assertSame('column', $asset->getType());
    }

}
