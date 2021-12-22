<?php

namespace Ork\Crom\Tests\Functional\Assertion\Index;

trait IndexNameMatchesCaseTrait
{

    public function testIndexNameMatchesCase(): void
    {
        $this->test([
            ['macroCase', 'pkey', false],
            ['macroCase', 'IDX_SLATE_DENSITY', true],
            ['macroCase', 'idxSlateIdDensity', false],
            ['snakeCase', 'pkey', true],
            ['snakeCase', 'IDX_SLATE_DENSITY', false],
            ['snakeCase', 'idxSlateIdDensity', false],
            ['camelCase', 'pkey', true],
            ['camelCase', 'IDX_SLATE_DENSITY', false],
            ['camelCase', 'idxSlateIdDensity', true],
        ]);
    }

}
