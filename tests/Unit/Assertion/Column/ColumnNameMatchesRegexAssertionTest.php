<?php

namespace Ork\Crom\Tests\Unit\Assertion\Column;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Types\StringType;
use Generator;
use Ork\Crom\Asset\ColumnAsset;
use Ork\Crom\Tests\Unit\Assertion\MatchesRegexTestTrait;

class ColumnNameMatchesRegexAssertionTest extends AbstractColumnAssertionTestCase
{

    use MatchesRegexTestTrait;

    public static function providerForRequiredParametersMissing(): Generator
    {
        yield [new ColumnAsset(new Table('FOO'), new Column('BAR', new StringType())), 'pattern'];
    }

}
