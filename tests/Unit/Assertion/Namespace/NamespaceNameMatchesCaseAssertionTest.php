<?php

namespace Ork\Crom\Tests\Unit\Assertion\Namespace;

use Generator;
use Ork\Crom\Asset\NamespaceAsset;
use Ork\Crom\Tests\Unit\Assertion\MatchesCaseTestTrait;
use RuntimeException;

class NamespaceNameMatchesCaseAssertionTest extends AbstractNamespaceAssertionTestCase
{

    use MatchesCaseTestTrait;

    public function providerForRequiredParametersMissing(): Generator
    {
        yield [new NamespaceAsset('FOO'), 'strategy'];
    }

    public function testUnknownStrategy()
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unknown casing strategy');
        $this->getAssertion(['strategy' => 'unknown'])(new NamespaceAsset('FOO'));
    }

}
