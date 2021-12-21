<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnIsAutoincrementTrait
{

    public function testColumnIsAutoincrement(): void
    {
        $this->test([
            ['autoinc', 'green', true],
            ['autoinc', 'yellow', false],
            ['autoinc', 'blue', false],
        ]);
    }

}
