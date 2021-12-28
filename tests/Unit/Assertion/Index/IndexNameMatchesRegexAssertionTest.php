<?php

namespace Ork\Crom\Tests\Unit\Assertion\Index;

use Doctrine\DBAL\Schema\Index;
use Doctrine\DBAL\Schema\Table;
use Generator;
use Ork\Crom\Asset\IndexAsset;
use Ork\Crom\Tests\Unit\Assertion\MatchesRegexTestTrait;

class IndexNameMatchesRegexAssertionTest extends AbstractIndexAssertionTestCase
{

    use MatchesRegexTestTrait;

    public function providerForRequiredParametersMissing(): Generator
    {
        yield [new IndexAsset(new Table('foo'), new Index('idx_foo', ['bar'])), 'pattern'];
    }

}
