<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnIsAutoincrementTrait
{

    public function testColumnIsAutoincrement(): void
    {
        $this->test([
            ['autoinc', 'green', LogLevel::NOTICE],
            ['autoinc', 'yellow', LogLevel::ERROR],
            ['autoinc', 'blue', LogLevel::ERROR],
        ]);
    }

}
