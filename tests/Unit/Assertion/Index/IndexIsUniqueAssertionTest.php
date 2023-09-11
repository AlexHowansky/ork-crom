<?php

namespace Ork\Crom\Tests\Unit\Assertion\Index;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\Index;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\IntegerType;
use Generator;
use Ork\Crom\Asset\IndexAsset;

class IndexIsUniqueAssertionTest extends AbstractIndexAssertionTestCase
{

    public static function providerForFail(): Generator
    {
        $column = new Column('bar', new IntegerType());
        $index = new Index('idx_foo', ['bar'], false);
        $table = new Table('foo', [$column], [$index]);
        yield [new IndexAsset($table, $index)];
    }

    public static function providerForPass(): Generator
    {
        $column = new Column('bar', new IntegerType());
        $index = new Index('idx_foo', ['bar'], true);
        $table = new Table('foo', [$column], [$index]);
        yield [new IndexAsset($table, $index)];
    }

}
