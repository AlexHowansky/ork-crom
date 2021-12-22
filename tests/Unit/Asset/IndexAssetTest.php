<?php

namespace Ork\Crom\Tests\Unit\Asset;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\Index;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\StringType;
use Ork\Crom\Asset\IndexAsset;
use PHPUnit\Framework\TestCase;

class IndexAssetTest extends TestCase
{

    public function testAsset(): void
    {
        $tableName = md5(random_bytes(32));
        $columnName = md5(random_bytes(32));
        $indexName = md5(random_bytes(32));
        $column = new Column($columnName, new StringType());
        $index = new Index($indexName, [$columnName]);
        $table = (new Table($tableName, [$column], [$index]));
        $asset = new IndexAsset($table, $index);
        $this->assertSame($column, $table->getColumn($columnName));
        $this->assertSame($index, $table->getIndex($indexName));
        $this->assertSame(sprintf('%s.%s', $tableName, $indexName), $asset->getLabel());
        $this->assertSame($indexName, $asset->getName());
        $this->assertSame($index, $asset->getIndex());
        $this->assertSame($table, $asset->getTable());
        $this->assertSame('index', $asset->getType());
    }

}
