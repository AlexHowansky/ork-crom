<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

trait ColumnIsNullableTrait
{

    public function testColumnIsNullable(): void
    {
        $this->test([
            ['isNullable', 'five_guys', false],
            ['isNullable', 'burger_fi', true],
            ['isNullable', 'sonic', true],
            ['isNullable', 'in_and_out', false],
        ]);
    }

}
