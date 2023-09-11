<?php

namespace Ork\Crom\Tests\Unit\Assertion\Column;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\IntegerType;
use Generator;
use Ork\Crom\Asset\ColumnAsset;

class ColumnHasDefaultAssertionTest extends AbstractColumnAssertionTestCase
{

    public static function providerForFail(): Generator
    {
        $column = new Column('foo', new IntegerType());
        $table = new Table('foo');
        yield [new ColumnAsset($table, $column)];
        yield [new ColumnAsset($table, $column), ['value' => 0]];
    }

    public static function providerForPass(): Generator
    {
        foreach ([-1, 0, 1] as $default) {
            $column = (new Column('foo', new IntegerType()))->setDefault($default);
            $table = new Table('foo');
            yield [new ColumnAsset($table, $column)];
            yield [new ColumnAsset($table, $column), ['value' => $default]];
        }
    }

}
