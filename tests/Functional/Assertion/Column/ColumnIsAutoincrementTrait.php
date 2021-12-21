<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnIsAutoincrementTrait
{

    public function testColumnIsAutoincrement(): void
    {
        $this->test([
            ['isAutoincrement', 'green', true],
            ['isAutoincrement', 'yellow', false],
            ['isAutoincrement', 'blue', false],
        ]);
    }

}
