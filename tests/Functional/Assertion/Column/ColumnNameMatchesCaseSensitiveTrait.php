<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnNameMatchesCaseSensitiveTrait
{

    public function testColumnNameMatchesCase(): void
    {
        $this->test([
            ['macro', 'ICE_COLD', true],
            ['macro', 'axe_murderer', false],
            ['macro', 'lastEmperor', false],
            ['macro', 'KoreanZombie', false],
            ['snake', 'ICE_COLD', false],
            ['snake', 'axe_murderer', true],
            ['snake', 'lastEmperor', false],
            ['snake', 'KoreanZombie', false],
            ['camel', 'ICE_COLD', false],
            ['camel', 'axe_murderer', false],
            ['camel', 'lastEmperor', true],
            ['camel', 'KoreanZombie', false],
        ]);
    }

}
