<?php

namespace Ork\Crom\Tests\Unit\Assertion;

use Generator;

/**
 * This trait contains pass and fail providers that are used to test all assertions which validate case matches.
 */
trait MatchesCaseTestTrait
{

    public function providerForFail(): Generator
    {
        yield from $this->providerGenerator([
            ['fooBar', ['strategy' => 'dot']],
            ['FooBar', ['strategy' => 'camel']],
            ['foo_bar', ['strategy' => 'pascal']],
            ['Foo_Bar', ['strategy' => 'snake']],
            ['FOO_BAR', ['strategy' => 'ada']],
            ['foo-bar', ['strategy' => 'macro']],
            ['Foo-Bar', ['strategy' => 'kebab']],
            ['FOO-BAR', ['strategy' => 'train']],
            ['foobar', ['strategy' => 'cobol']],
            ['FOOBAR', ['strategy' => 'lower']],
            ['Foo Bar', ['strategy' => 'upper']],
            ['Foo bar', ['strategy' => 'title']],
            ['foo.bar', ['strategy' => 'sentence']],
        ]);
    }

    public function providerForPass(): Generator
    {
        yield from $this->providerGenerator([
            ['fooBar', ['strategy' => 'camel']],
            ['FooBar', ['strategy' => 'pascal']],
            ['foo_bar', ['strategy' => 'snake']],
            ['Foo_Bar', ['strategy' => 'ada']],
            ['FOO_BAR', ['strategy' => 'macro']],
            ['foo-bar', ['strategy' => 'kebab']],
            ['Foo-Bar', ['strategy' => 'train']],
            ['FOO-BAR', ['strategy' => 'cobol']],
            ['foobar', ['strategy' => 'lower']],
            ['FOOBAR', ['strategy' => 'upper']],
            ['Foo Bar', ['strategy' => 'title']],
            ['Foo bar', ['strategy' => 'sentence']],
            ['foo.bar', ['strategy' => 'dot']],
        ]);
    }

}
