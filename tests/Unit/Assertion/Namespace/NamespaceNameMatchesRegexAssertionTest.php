<?php

namespace Ork\Crom\Tests\Unit\Assertion\Namespace;

use Generator;
use Ork\Crom\Asset\NamespaceAsset;
use Ork\Crom\Tests\Unit\Assertion\MatchesRegexTestTrait;

class NamespaceNameMatchesRegexAssertionTest extends AbstractNamespaceAssertionTestCase
{

    use MatchesRegexTestTrait;

    public static function providerForRequiredParametersMissing(): Generator
    {
        yield [new NamespaceAsset('FOO'), 'pattern'];
    }

}
