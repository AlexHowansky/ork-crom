<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnIsPrimaryKeyTrait
{

    public function testColumnIsPrimaryKey(): void
    {
        $this->test([
            ['pkey', 'peanuts', LogLevel::NOTICE],
            ['pkey', 'mars', LogLevel::ERROR],
            ['pkey', 'gummy_bears', LogLevel::ERROR],
            ['pkey', 'starburst', LogLevel::ERROR],
        ]);
    }

}
