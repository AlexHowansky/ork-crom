<?php

namespace Ork\Crom\Tests\Unit\Assertion\Column;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\IntegerType;
use Generator;
use Ork\Crom\Asset\ColumnAsset;

class ColumnIsNullableAssertionTest extends AbstractColumnAssertionTestCase
{

    public function providerForFail(): Generator
    {
        $column = (new Column('foo', new IntegerType()))->setNotnull(true);
        $table = new Table('foo');
        yield [new ColumnAsset($table, $column)];
    }

    public function providerForPass(): Generator
    {
        $column = (new Column('foo', new IntegerType()))->setNotnull(false);
        $table = new Table('foo');
        yield [new ColumnAsset($table, $column)];
    }

}
