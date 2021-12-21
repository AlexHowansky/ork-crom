<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnNameMatchesCaseSensitiveTrait
{

    public function testColumnNameMatchesCase(): void
    {
        $this->test([
            ['macroCase', 'ICE_COLD', true],
            ['macroCase', 'axe_murderer', false],
            ['macroCase', 'lastEmperor', false],
            ['macroCase', 'KoreanZombie', false],
            ['snakeCase', 'ICE_COLD', false],
            ['snakeCase', 'axe_murderer', true],
            ['snakeCase', 'lastEmperor', false],
            ['snakeCase', 'KoreanZombie', false],
            ['camelCase', 'ICE_COLD', false],
            ['camelCase', 'axe_murderer', false],
            ['camelCase', 'lastEmperor', true],
            ['camelCase', 'KoreanZombie', false],
        ]);
    }

}
