<?php

namespace Ork\Crom\Tests\Functional\Assertion\Index;

trait IndexNameMatchesCaseForcedUpperTrait
{

    public function testIndexNameMatchesCase(): void
    {
        $this->test([
            ['macroCase', 'PKEY', true],
            ['macroCase', 'IDX_SLATE_DENSITY', true],
            ['macroCase', 'IDXSLATEIDDENSITY', true],
            ['snakeCase', 'PKEY', false],
            ['snakeCase', 'IDX_SLATE_DENSITY', false],
            ['snakeCase', 'IDXSLATEIDDENSITY', false],
            ['camelCase', 'PKEY', false],
            ['camelCase', 'IDX_SLATE_DENSITY', false],
            ['camelCase', 'IDXSLATEIDDENSITY', false],
        ]);
    }

}
