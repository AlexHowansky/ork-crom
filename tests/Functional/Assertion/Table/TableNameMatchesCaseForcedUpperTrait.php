<?php

namespace Ork\Crom\Tests\Functional\Assertion\Table;

trait TableNameMatchesCaseForcedUpperTrait
{

    public function testTableNameMatchesCase(): void
    {
        $this->test([
            ['macro', 'TOMATO_CAN', true],
            ['macro', 'GREEN_BOTTLE', true],
            ['macro', 'LOGOCIRCLE', true],
            ['macro', 'SWEETGARDEN', true],
            ['snake', 'TOMATO_CAN', false],
            ['snake', 'GREEN_BOTTLE', false],
            ['snake', 'LOGOCIRCLE', false],
            ['snake', 'SWEETGARDEN', false],
            ['camel', 'TOMATO_CAN', false],
            ['camel', 'GREEN_BOTTLE', false],
            ['camel', 'LOGOCIRCLE', false],
            ['camel', 'SWEETGARDEN', false],
        ]);
    }

}
