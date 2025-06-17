<?php

namespace Ork\Crom\Tests\Unit\Assertion\Namespace;

use Generator;
use Ork\Crom\Asset\NamespaceAsset;
use Ork\Crom\Tests\Unit\Assertion\MatchesRegexTestTrait;
use Override;

class NamespaceNameMatchesRegexAssertionTest extends AbstractNamespaceAssertionTestCase
{

    use MatchesRegexTestTrait;

    #[Override]
    public static function providerForRequiredParametersMissing(): Generator
    {
        yield [new NamespaceAsset('FOO'), 'pattern'];
    }

}
