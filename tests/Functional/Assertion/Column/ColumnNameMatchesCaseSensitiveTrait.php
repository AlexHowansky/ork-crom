<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnNameMatchesCaseSensitiveTrait
{

    public function testColumnNameMatchesCase(): void
    {
        $this->test([
            ['macro', 'ICE_COLD', LogLevel::NOTICE],
            ['macro', 'axe_murderer', LogLevel::ERROR],
            ['macro', 'lastEmperor', LogLevel::ERROR],
            ['macro', 'KoreanZombie', LogLevel::ERROR],
            ['snake', 'ICE_COLD', LogLevel::ERROR],
            ['snake', 'axe_murderer', LogLevel::NOTICE],
            ['snake', 'lastEmperor', LogLevel::ERROR],
            ['snake', 'KoreanZombie', LogLevel::ERROR],
            ['camel', 'ICE_COLD', LogLevel::ERROR],
            ['camel', 'axe_murderer', LogLevel::ERROR],
            ['camel', 'lastEmperor', LogLevel::NOTICE],
            ['camel', 'KoreanZombie', LogLevel::ERROR],
        ]);
    }

}
