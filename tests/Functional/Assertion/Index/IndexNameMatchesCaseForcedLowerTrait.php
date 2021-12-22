<?php

namespace Ork\Crom\Tests\Functional\Assertion\Index;

trait IndexNameMatchesCaseForcedLowerTrait
{

    public function testIndexNameMatchesCase(): void
    {
        $this->test([
            ['macroCase', 'pkey', false],
            ['macroCase', 'idx_slate_density', false],
            ['macroCase', 'idxslateiddensity', false],
            ['snakeCase', 'pkey', true],
            ['snakeCase', 'idx_slate_density', true],
            ['snakeCase', 'idxslateiddensity', true],
            ['camelCase', 'pkey', true],
            ['camelCase', 'idx_slate_density', false],
            ['camelCase', 'idxslateiddensity', true],
        ]);
    }

}
