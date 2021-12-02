<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnIsNullableTrait
{

    public function testColumnIsNullable(): void
    {
        $this->test([
            ['nullable', 'five_guys', LogLevel::ERROR],
            ['nullable', 'burger_fi', LogLevel::NOTICE],
            ['nullable', 'sonic', LogLevel::NOTICE],
            ['nullable', 'in_and_out', LogLevel::ERROR],
        ]);
    }

}
