<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnIsPrimaryKeyTrait
{

    public function testColumnIsPrimaryKey(): void
    {
        $this->test([
            ['pkey', 'peanuts', true],
            ['pkey', 'mars', false],
            ['pkey', 'gummy_bears', false],
            ['pkey', 'starburst', false],
        ]);
    }

}
