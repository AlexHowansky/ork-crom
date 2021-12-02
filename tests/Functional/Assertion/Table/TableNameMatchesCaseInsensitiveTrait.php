<?php

namespace Ork\Crom\Tests\Functional\Assertion\Table;

use Psr\Log\LogLevel;

trait TableNameMatchesCaseInsensitiveTrait
{

    public function testTableNameMatchesCase(): void
    {
        $this->test([
            ['macro', 'tomato_can', LogLevel::ERROR],
            ['macro', 'green_bottle', LogLevel::ERROR],
            ['macro', 'logocircle', LogLevel::ERROR],
            ['macro', 'sweetgarden', LogLevel::ERROR],
            ['snake', 'tomato_can', LogLevel::NOTICE],
            ['snake', 'green_bottle', LogLevel::NOTICE],
            ['snake', 'logocircle', LogLevel::NOTICE],
            ['snake', 'sweetgarden', LogLevel::NOTICE],
            ['camel', 'tomato_can', LogLevel::ERROR],
            ['camel', 'green_bottle', LogLevel::ERROR],
            ['camel', 'logocircle', LogLevel::NOTICE],
            ['camel', 'sweetgarden', LogLevel::NOTICE],
        ]);
    }

}
