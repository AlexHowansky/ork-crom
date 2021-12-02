<?php

namespace Ork\Crom\Tests\Unit\Assertion;

use Generator;

/**
 * This trait contains pass and fail providers that are used to test all assertions which validate regex matches.
 */
trait MatchesRegexTestTrait
{

    public function providerForFail(): Generator
    {
        yield from $this->providerGenerator([
            ['FOO', ['pattern' => '/^f/']],
            ['FOO', ['pattern' => '/x$/']],
            ['FOO-BAR', ['pattern' => '/^[FO]+$/']],
            ['FOO-BAR', ['pattern' => '/^WEB_/']],
        ]);
    }

    public function providerForPass(): Generator
    {
        yield from $this->providerGenerator([
            ['FOO', ['pattern' => '/^F/']],
            ['FOO', ['pattern' => '/^f/i']],
            ['FOO', ['pattern' => '/^[FO]+$/']],
            ['FOO_BAR', ['pattern' => '/_/']],
        ]);
    }

}
