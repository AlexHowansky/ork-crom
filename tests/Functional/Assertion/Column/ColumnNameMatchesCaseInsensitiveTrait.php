<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnNameMatchesCaseInsensitiveTrait
{

    public function testColumnNameMatchesCase(): void
    {
        $this->test([
            ['macro', 'ice_cold', false],
            ['macro', 'axe_murderer',false],
            ['macro', 'lastemperor', false],
            ['macro', 'koreanzombie', false],
            ['snake', 'ice_cold', true],
            ['snake', 'axe_murderer', true],
            ['snake', 'lastemperor', true],
            ['snake', 'koreanzombie', true],
            ['camel', 'ice_cold', false],
            ['camel', 'axe_murderer', false],
            ['camel', 'lastemperor', true],
            ['camel', 'koreanzombie', true],
        ]);
    }

}
