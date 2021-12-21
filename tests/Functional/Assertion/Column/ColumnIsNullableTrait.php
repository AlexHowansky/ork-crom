<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnIsNullableTrait
{

    public function testColumnIsNullable(): void
    {
        $this->test([
            ['nullable', 'five_guys', false],
            ['nullable', 'burger_fi', true],
            ['nullable', 'sonic', true],
            ['nullable', 'in_and_out', false],
        ]);
    }

}
