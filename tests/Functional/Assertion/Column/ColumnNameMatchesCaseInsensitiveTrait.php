<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnNameMatchesCaseInsensitiveTrait
{

    public function testColumnNameMatchesCase(): void
    {
        $this->test([
            ['macroCase', 'ice_cold', false],
            ['macroCase', 'axe_murderer',false],
            ['macroCase', 'lastemperor', false],
            ['macroCase', 'koreanzombie', false],
            ['snakeCase', 'ice_cold', true],
            ['snakeCase', 'axe_murderer', true],
            ['snakeCase', 'lastemperor', true],
            ['snakeCase', 'koreanzombie', true],
            ['camelCase', 'ice_cold', false],
            ['camelCase', 'axe_murderer', false],
            ['camelCase', 'lastemperor', true],
            ['camelCase', 'koreanzombie', true],
        ]);
    }

}
