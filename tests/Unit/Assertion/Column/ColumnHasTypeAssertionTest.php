<?php

namespace Ork\Crom\Tests\Unit\Assertion\Column;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\Type;
use Generator;
use Ork\Crom\Asset\ColumnAsset;

class ColumnHasTypeAssertionTest extends AbstractColumnAssertionTestCase
{

    public function providerForFail(): Generator
    {
        foreach (Type::getTypesMap() as $name => $type) {
            $column = new Column('foo', Type::getType($name));
            $table = new Table('foo');
            yield [new ColumnAsset($table, $column), ['type' => 'noSuchType']];
        }
    }

    public function providerForPass(): Generator
    {
        foreach (Type::getTypesMap() as $name => $type) {
            $column = new Column('foo', Type::getType($name));
            $table = new Table('foo');
            yield [new ColumnAsset($table, $column), ['type' => $name]];
        }
    }

}
