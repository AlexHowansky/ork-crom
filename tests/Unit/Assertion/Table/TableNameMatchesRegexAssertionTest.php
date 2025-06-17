<?php

namespace Ork\Crom\Tests\Unit\Assertion\Table;

use Doctrine\DBAL\Schema\Table;
use Generator;
use Ork\Crom\Asset\TableAsset;
use Ork\Crom\Tests\Unit\Assertion\MatchesRegexTestTrait;
use Override;

class TableNameMatchesRegexAssertionTest extends AbstractTableAssertionTestCase
{

    use MatchesRegexTestTrait;

    #[Override]
    public static function providerForRequiredParametersMissing(): Generator
    {
        yield [new TableAsset(new Table('FOO')), 'pattern'];
    }

}
