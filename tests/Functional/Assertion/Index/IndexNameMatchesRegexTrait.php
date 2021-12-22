<?php

namespace Ork\Crom\Tests\Functional\Assertion\Index;

trait IndexNameMatchesRegexTrait
{

    public function testIndexNameMatchesRegex(): void
    {
        $this->test([
            ['containsUnderscore', 'pkey', false],
            ['containsUnderscore', 'idx_sand_name', true],
        ]);
    }

}
