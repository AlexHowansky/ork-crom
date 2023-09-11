<?php

namespace Ork\Crom\Tests\Unit\Assertion;

use Generator;

/**
 * This trait contains pass and fail providers that are used to test all assertions which validate regex matches.
 */
trait MatchesRegexTestTrait
{

    public static function providerForFail(): Generator
    {
        yield from static::providerGenerator([
            ['FOO', ['pattern' => '/^f/']],
            ['FOO', ['pattern' => '/x$/']],
            ['FOO-BAR', ['pattern' => '/^[FO]+$/']],
            ['FOO-BAR', ['pattern' => '/^WEB_/']],
        ]);
    }

    public static function providerForPass(): Generator
    {
        yield from static::providerGenerator([
            ['FOO', ['pattern' => '/^F/']],
            ['FOO', ['pattern' => '/^f/i']],
            ['FOO', ['pattern' => '/^[FO]+$/']],
            ['FOO_BAR', ['pattern' => '/_/']],
        ]);
    }

}
