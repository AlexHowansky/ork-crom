<?php

namespace Ork\Crom\Tests\Unit\Assertion\Column;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\StringType;
use Generator;
use Ork\Crom\Asset\ColumnAsset;

class ColumnHasLengthAtLeastAssertionTest extends AbstractColumnAssertionTestCase
{

    public static function providerForFail(): Generator
    {
        foreach ([new IntegerType(), new StringType()] as $type) {
            for ($i = 1; $i <= 5; $i++) {
                $column = new Column('foo', $type, ['length' => $i]);
                $table = new Table('foo');
                yield [new ColumnAsset($table, $column), ['length' => $i + 1]];
            }
        }
    }

    public static function providerForPass(): Generator
    {
        foreach ([new IntegerType(), new StringType()] as $type) {
            for ($i = 2; $i <= 6; $i++) {
                $column = new Column('foo', new StringType(), ['length' => $i]);
                $table = new Table('foo');
                yield [new ColumnAsset($table, $column), ['length' => $i]];
                yield [new ColumnAsset($table, $column), ['length' => $i - 1]];
            }
        }
    }

}
