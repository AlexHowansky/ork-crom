<?php

namespace Ork\Crom\Tests\Functional\Assertion\Table;

trait TableNameMatchesCaseForcedUpperTrait
{

    public function testTableNameMatchesCase(): void
    {
        $this->test([
            ['macroCase', 'TOMATO_CAN', true],
            ['macroCase', 'GREEN_BOTTLE', true],
            ['macroCase', 'LOGOCIRCLE', true],
            ['macroCase', 'SWEETGARDEN', true],
            ['snakeCase', 'TOMATO_CAN', false],
            ['snakeCase', 'GREEN_BOTTLE', false],
            ['snakeCase', 'LOGOCIRCLE', false],
            ['snakeCase', 'SWEETGARDEN', false],
            ['camelCase', 'TOMATO_CAN', false],
            ['camelCase', 'GREEN_BOTTLE', false],
            ['camelCase', 'LOGOCIRCLE', false],
            ['camelCase', 'SWEETGARDEN', false],
        ]);
    }

}
