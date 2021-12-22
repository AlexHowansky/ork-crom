<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

trait ColumnNameMatchesCaseForcedUpperTrait
{

    public function testColumnNameMatchesCase(): void
    {
        $this->test([
            ['macroCase', 'ICE_COLD', true],
            ['macroCase', 'AXE_MURDERER',true],
            ['macroCase', 'LASTEMPEROR', true],
            ['macroCase', 'KOREANZOMBIE', true],
            ['snakeCase', 'ICE_COLD', false],
            ['snakeCase', 'AXE_MURDERER', false],
            ['snakeCase', 'LASTEMPEROR', false],
            ['snakeCase', 'KOREANZOMBIE', false],
            ['camelCase', 'ICE_COLD', false],
            ['camelCase', 'AXE_MURDERER', false],
            ['camelCase', 'LASTEMPEROR', false],
            ['camelCase', 'KOREANZOMBIE', false],
        ]);
    }

}
