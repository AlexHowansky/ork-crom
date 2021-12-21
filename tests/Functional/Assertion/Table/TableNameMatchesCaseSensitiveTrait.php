<?php

namespace Ork\Crom\Tests\Functional\Assertion\Table;

trait TableNameMatchesCaseSensitiveTrait
{

    public function testTableNameMatchesCase(): void
    {
        $this->test([
            ['macro', 'TOMATO_CAN', true],
            ['macro', 'green_bottle', false],
            ['macro', 'logoCircle', false],
            ['macro', 'SweetGarden', false],
            ['snake', 'TOMATO_CAN', false],
            ['snake', 'green_bottle', true],
            ['snake', 'logoCircle', false],
            ['snake', 'SweetGarden', false],
            ['camel', 'TOMATO_CAN', false],
            ['camel', 'green_bottle', false],
            ['camel', 'logoCircle', true],
            ['camel', 'SweetGarden', false],
        ]);
    }

}
