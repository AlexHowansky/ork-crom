<?php

namespace Ork\Crom\Tests\Unit\Assertion\Table;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\Index;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\StringType;
use Generator;
use Ork\Crom\Asset\ColumnAsset;
use Ork\Crom\Asset\IndexAsset;
use Ork\Crom\Asset\NamespaceAsset;
use Ork\Crom\Asset\TableAsset;
use Ork\Crom\Tests\Unit\Assertion\AbstractAssertionTestCase;

abstract class AbstractTableAssertionTestCase extends AbstractAssertionTestCase
{

    public function providerForBadType(): Generator
    {
        yield [new ColumnAsset(new Table('foo'), new Column('bar', new StringType()))];
        yield [new IndexAsset(new Table('foo'), new Index('idx_foo', ['bar']))];
        yield [new NamespaceAsset('foo')];
    }

    protected function providerGenerator(array $cases): Generator
    {
        foreach ($cases as [$name, $config]) {
            yield [new TableAsset(new Table($name)), $config];
        }
    }

}
