<?php

namespace Ork\Crom\Tests\Unit\Assertion\Column;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\IntegerType;
use Generator;
use Ork\Crom\Asset\ColumnAsset;

class ColumnIsAutoincrementAssertionTest extends AbstractColumnAssertionTestCase
{

    public static function providerForFail(): Generator
    {
        $column = (new Column('foo', new IntegerType()))->setAutoincrement(false);
        $table = new Table('foo');
        yield [new ColumnAsset($table, $column)];
    }

    public static function providerForPass(): Generator
    {
        $column = (new Column('foo', new IntegerType()))->setAutoincrement(true);
        $table = new Table('foo');
        yield [new ColumnAsset($table, $column)];
    }

}
