<?php

namespace Ork\Crom\Tests\Unit\Assertion\Namespace;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\StringType;
use Generator;
use Ork\Crom\Asset\ColumnAsset;
use Ork\Crom\Asset\NamespaceAsset;
use Ork\Crom\Asset\TableAsset;
use Ork\Crom\Tests\Unit\Assertion\AbstractAssertionTestCase;

abstract class AbstractNamespaceAssertionTestCase extends AbstractAssertionTestCase
{

    public function providerForBadType(): Generator
    {
        yield [new ColumnAsset(new Table('foo'), new Column('bar', new StringType()))];
        yield [new TableAsset(new Table('foo'))];
    }

    protected function providerGenerator(array $cases): Generator
    {
        foreach ($cases as [$name, $config]) {
            yield [new NamespaceAsset($name), $config];
        }
    }

}
