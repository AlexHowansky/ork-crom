<?php

namespace Ork\Crom\Tests\Unit\Assertion\Column;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\StringType;
use Generator;
use Ork\Crom\Asset\ColumnAsset;
use Ork\Crom\Tests\Unit\Assertion\MatchesCaseTestTrait;
use RuntimeException;

class ColumnNameMatchesCaseAssertionTest extends AbstractColumnAssertionTestCase
{

    use MatchesCaseTestTrait;

    public static function providerForRequiredParametersMissing(): Generator
    {
        yield [new ColumnAsset(new Table('FOO'), new Column('BAR', new StringType())), 'strategy'];
    }

    public function testUnknownStrategy()
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unknown casing strategy');
        $this->getAssertion(['strategy' => 'unknown'])(
            new ColumnAsset(new Table('FOO'), new Column('BAR', new StringType()))
        );
    }

}
