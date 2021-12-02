<?php

namespace Ork\Crom\Tests\Unit\Assertion\Table;

use Doctrine\DBAL\Schema\Table;
use Generator;
use Ork\Crom\Asset\TableAsset;
use Ork\Crom\Tests\Unit\Assertion\MatchesCaseTestTrait;
use RuntimeException;

class TableNameMatchesCaseAssertionTest extends AbstractTableAssertionTestCase
{

    use MatchesCaseTestTrait;

    public function providerForRequiredParametersMissing(): Generator
    {
        yield [new TableAsset(new Table('FOO')), 'strategy'];
    }

    public function testUnknownStrategy()
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unknown casing strategy');
        $this->getAssertion(['strategy' => 'unknown'])(new TableAsset(new Table('FOO')));
    }

}
