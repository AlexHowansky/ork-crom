<?php

namespace Ork\Crom\Tests\Functional\Assertion\Table;

trait TableNameMatchesCaseTrait
{

    public function testTableNameMatchesCase(): void
    {
        $this->test([
            ['macroCase', 'TOMATO_CAN', true],
            ['macroCase', 'green_bottle', false],
            ['macroCase', 'logoCircle', false],
            ['macroCase', 'SweetGarden', false],
            ['snakeCase', 'TOMATO_CAN', false],
            ['snakeCase', 'green_bottle', true],
            ['snakeCase', 'logoCircle', false],
            ['snakeCase', 'SweetGarden', false],
            ['camelCase', 'TOMATO_CAN', false],
            ['camelCase', 'green_bottle', false],
            ['camelCase', 'logoCircle', true],
            ['camelCase', 'SweetGarden', false],
        ]);
    }

}
