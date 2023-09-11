<?php

namespace Ork\Crom\Tests\Unit\Assertion\Column;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\Type;
use Generator;
use Ork\Crom\Asset\ColumnAsset;

class ColumnHasTypeAssertionTest extends AbstractColumnAssertionTestCase
{

    public static function providerForFail(): Generator
    {
        foreach (Type::getTypesMap() as $name => $type) {
            $column = new Column('foo', Type::getType($name));
            $table = new Table('foo');
            yield [new ColumnAsset($table, $column), ['type' => 'noSuchType']];
        }
    }

    public static function providerForPass(): Generator
    {
        yield from static::providerForPassSingle();
        yield from static::providerforPassMultiple();
    }

    protected static function providerforPassMultiple(): Generator
    {
        foreach (['bigint', 'integer', 'smallint'] as $type) {
            $column = new Column('foo', Type::getType($type));
            $table = new Table('foo');
            yield [new ColumnAsset($table, $column), ['type' => 'bigint|integer|smallint']];
        }
    }

    protected static function providerForPassSingle(): Generator
    {
        foreach (array_keys(Type::getTypesMap()) as $type) {
            $column = new Column('foo', Type::getType($type));
            $table = new Table('foo');
            yield [new ColumnAsset($table, $column), ['type' => strtolower($type)]];
            yield [new ColumnAsset($table, $column), ['type' => strtoupper($type)]];
        }
    }

}
