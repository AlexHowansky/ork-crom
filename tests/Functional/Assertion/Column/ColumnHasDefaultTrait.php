<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnHasDefaultTrait
{

    public function testColumnHasDefault(): void
    {
        $this->test([
            ['anyDefault', 'spain', LogLevel::NOTICE],
            ['anyDefault', 'france', LogLevel::ERROR],
            ['anyDefault', 'vietnam', LogLevel::NOTICE],
            ['anyDefault', 'laos', LogLevel::NOTICE],
            ['zeroDefault', 'spain', LogLevel::NOTICE],
            ['zeroDefault', 'france', LogLevel::ERROR],
            ['zeroDefault', 'vietnam', LogLevel::ERROR],
            ['zeroDefault', 'laos', LogLevel::ERROR],
            ['fooDefault', 'spain', LogLevel::ERROR],
            ['fooDefault', 'france', LogLevel::ERROR],
            ['fooDefault', 'vietnam', LogLevel::NOTICE],
            ['fooDefault', 'laos', LogLevel::ERROR],
        ]);
    }

}
