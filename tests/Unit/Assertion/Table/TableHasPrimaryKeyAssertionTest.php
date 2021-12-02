<?php

namespace Ork\Crom\Tests\Unit\Assertion\Table;

use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\Types;
use Generator;
use Ork\Crom\Asset\TableAsset;

class TableHasPrimaryKeyAssertionTest extends AbstractTableAssertionTestCase
{

    public function providerForFail(): Generator
    {
        yield [new TableAsset(new Table('foo'))];
    }

    public function providerForPass(): Generator
    {
        $table = new Table('foo');
        $table->addColumn('bar', Types::INTEGER);
        $table->setPrimaryKey(['bar']);
        yield [new TableAsset($table)];

        $table = new Table('foo');
        $table->addColumn('bar', Types::INTEGER);
        $table->addColumn('baz', Types::INTEGER);
        $table->setPrimaryKey(['bar', 'baz']);
        yield [new TableAsset($table)];
    }

}
