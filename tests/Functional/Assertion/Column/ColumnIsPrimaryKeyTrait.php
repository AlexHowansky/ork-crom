<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnIsPrimaryKeyTrait
{

    public function testColumnIsPrimaryKey(): void
    {
        $this->test([
            ['isPkey', 'peanuts', true],
            ['isPkey', 'mars', false],
            ['isPkey', 'gummy_bears', false],
            ['isPkey', 'starburst', false],
        ]);
    }

}
