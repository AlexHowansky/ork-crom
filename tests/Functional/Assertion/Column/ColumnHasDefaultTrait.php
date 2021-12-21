<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnHasDefaultTrait
{

    public function testColumnHasDefault(): void
    {
        $this->test([
            ['anyDefault', 'spain', true],
            ['anyDefault', 'france', false],
            ['anyDefault', 'vietnam', true],
            ['anyDefault', 'laos', true],
            ['zeroDefault', 'spain', true],
            ['zeroDefault', 'france', false],
            ['zeroDefault', 'vietnam', false],
            ['zeroDefault', 'laos', false],
            ['fooDefault', 'spain', false],
            ['fooDefault', 'france', false],
            ['fooDefault', 'vietnam', true],
            ['fooDefault', 'laos', false],
        ]);
    }

}
