<?php

namespace Ork\Crom\Tests\Functional\Assertion\Table;

use Psr\Log\LogLevel;

trait TableNameMatchesCaseForcedUpperTrait
{

    public function testTableNameMatchesCase(): void
    {
        $this->test([
            ['macro', 'TOMATO_CAN', LogLevel::NOTICE],
            ['macro', 'GREEN_BOTTLE', LogLevel::NOTICE],
            ['macro', 'LOGOCIRCLE', LogLevel::NOTICE],
            ['macro', 'SWEETGARDEN', LogLevel::NOTICE],
            ['snake', 'TOMATO_CAN', LogLevel::ERROR],
            ['snake', 'GREEN_BOTTLE', LogLevel::ERROR],
            ['snake', 'LOGOCIRCLE', LogLevel::ERROR],
            ['snake', 'SWEETGARDEN', LogLevel::ERROR],
            ['camel', 'TOMATO_CAN', LogLevel::ERROR],
            ['camel', 'GREEN_BOTTLE', LogLevel::ERROR],
            ['camel', 'LOGOCIRCLE', LogLevel::ERROR],
            ['camel', 'SWEETGARDEN', LogLevel::ERROR],
        ]);
    }

}
