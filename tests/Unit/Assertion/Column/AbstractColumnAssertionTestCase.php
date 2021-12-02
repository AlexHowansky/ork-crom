<?php

namespace Ork\Crom\Tests\Unit\Assertion\Column;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\StringType;
use Generator;
use Ork\Crom\Asset\ColumnAsset;
use Ork\Crom\Asset\NamespaceAsset;
use Ork\Crom\Asset\TableAsset;
use Ork\Crom\Tests\Unit\Assertion\AbstractAssertionTestCase;

abstract class AbstractColumnAssertionTestCase extends AbstractAssertionTestCase
{

    public function providerForBadType(): Generator
    {
        yield [new NamespaceAsset('foo')];
        yield [new TableAsset(new Table('Foo'))];
    }

    protected function providerGenerator(array $cases): Generator
    {
        foreach ($cases as [$name, $config]) {
            yield [new ColumnAsset(new Table('foo'), new Column($name, new StringType())), $config];
        }
    }

    protected function providerGeneratorForeignKey(array $cases): Generator
    {
        foreach ($cases as [$testColumn, $createColumns, $keyColumns]) {
            $columns = array_map(fn($name) => new Column($name, new IntegerType()), $createColumns);
            $table = new Table('local', $columns);
            if (empty($keyColumns) === false) {
                $table->addForeignKeyConstraint(new Table('foreign', $columns), $keyColumns, $keyColumns);
            }
            yield [new ColumnAsset($table, $table->getColumn($testColumn))];
        }
    }

    protected function providerGeneratorPrimaryKey(array $cases): Generator
    {
        foreach ($cases as [$testColumn, $createColumns, $keyColumns]) {
            $columns = array_map(fn($name) => new Column($name, new IntegerType()), $createColumns);
            $table = new Table('foo', $columns);
            // @see https://github.com/doctrine/dbal/issues/4905
            if (empty($keyColumns) === false) {
                $table->setPrimaryKey($keyColumns);
            }
            yield [new ColumnAsset($table, $table->getColumn($testColumn))];
        }
    }

}
