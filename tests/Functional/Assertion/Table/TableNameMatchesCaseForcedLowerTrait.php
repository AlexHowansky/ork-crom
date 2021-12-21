<?php

namespace Ork\Crom\Tests\Functional\Assertion\Table;

trait TableNameMatchesCaseForcedLowerTrait
{

    public function testTableNameMatchesCase(): void
    {
        $this->test([
            ['macroCase', 'tomato_can', false],
            ['macroCase', 'green_bottle', false],
            ['macroCase', 'logocircle', false],
            ['macroCase', 'sweetgarden', false],
            ['snakeCase', 'tomato_can', true],
            ['snakeCase', 'green_bottle', true],
            ['snakeCase', 'logocircle', true],
            ['snakeCase', 'sweetgarden', true],
            ['camelCase', 'tomato_can', false],
            ['camelCase', 'green_bottle', false],
            ['camelCase', 'logocircle', true],
            ['camelCase', 'sweetgarden', true],
        ]);
    }

}
