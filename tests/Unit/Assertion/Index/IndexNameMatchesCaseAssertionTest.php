<?php

namespace Ork\Crom\Tests\Unit\Assertion\Index;

use Doctrine\DBAL\Schema\Index;
use Doctrine\DBAL\Schema\Table;
use Generator;
use Ork\Crom\Asset\IndexAsset;
use Ork\Crom\Tests\Unit\Assertion\MatchesCaseTestTrait;
use RuntimeException;

class IndexNameMatchesCaseAssertionTest extends AbstractIndexAssertionTestCase
{

    use MatchesCaseTestTrait;

    public function providerForRequiredParametersMissing(): Generator
    {
        yield [new IndexAsset(new Table('foo'), new Index('idx_foo', ['bar'])), 'strategy'];
    }

    public function testUnknownStrategy()
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unknown casing strategy');
        $this->getAssertion(['strategy' => 'unknown'])(
            new IndexAsset(new Table('foo'), new Index('idx_foo', ['bar']))
        );
    }

}
