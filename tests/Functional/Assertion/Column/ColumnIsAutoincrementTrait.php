<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

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
