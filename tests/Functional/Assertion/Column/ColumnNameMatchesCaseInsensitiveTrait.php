<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnNameMatchesCaseInsensitiveTrait
{

    public function testColumnNameMatchesCase(): void
    {
        $this->test([
            ['macro', 'ice_cold', LogLevel::ERROR],
            ['macro', 'axe_murderer',LogLevel::ERROR],
            ['macro', 'lastemperor', LogLevel::ERROR],
            ['macro', 'koreanzombie', LogLevel::ERROR],
            ['snake', 'ice_cold', LogLevel::NOTICE],
            ['snake', 'axe_murderer', LogLevel::NOTICE],
            ['snake', 'lastemperor', LogLevel::NOTICE],
            ['snake', 'koreanzombie', LogLevel::NOTICE],
            ['camel', 'ice_cold', LogLevel::ERROR],
            ['camel', 'axe_murderer', LogLevel::ERROR],
            ['camel', 'lastemperor', LogLevel::NOTICE],
            ['camel', 'koreanzombie', LogLevel::NOTICE],
        ]);
    }

}
