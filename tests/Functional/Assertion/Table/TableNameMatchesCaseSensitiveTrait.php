<?php

namespace Ork\Crom\Tests\Functional\Assertion\Table;

use Psr\Log\LogLevel;

trait TableNameMatchesCaseSensitiveTrait
{

    public function testTableNameMatchesCase(): void
    {
        $this->test([
            ['macro', 'TOMATO_CAN', LogLevel::NOTICE],
            ['macro', 'green_bottle', LogLevel::ERROR],
            ['macro', 'logoCircle', LogLevel::ERROR],
            ['macro', 'SweetGarden', LogLevel::ERROR],
            ['snake', 'TOMATO_CAN', LogLevel::ERROR],
            ['snake', 'green_bottle', LogLevel::NOTICE],
            ['snake', 'logoCircle', LogLevel::ERROR],
            ['snake', 'SweetGarden', LogLevel::ERROR],
            ['camel', 'TOMATO_CAN', LogLevel::ERROR],
            ['camel', 'green_bottle', LogLevel::ERROR],
            ['camel', 'logoCircle', LogLevel::NOTICE],
            ['camel', 'SweetGarden', LogLevel::ERROR],
        ]);
    }

}
