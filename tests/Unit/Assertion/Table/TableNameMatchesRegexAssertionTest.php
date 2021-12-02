<?php

namespace Ork\Crom\Tests\Unit\Assertion\Table;

use Doctrine\DBAL\Schema\Table;
use Generator;
use Ork\Crom\Asset\TableAsset;
use Ork\Crom\Tests\Unit\Assertion\MatchesRegexTestTrait;

class TableNameMatchesRegexAssertionTest extends AbstractTableAssertionTestCase
{

    use MatchesRegexTestTrait;

    public function providerForRequiredParametersMissing(): Generator
    {
        yield [new TableAsset(new Table('FOO')), 'pattern'];
    }

}
