<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnHasLengthTrait
{

    public function testColumnHasLength(): void
    {
        $this->test([
            ['length 10', 'celica', LogLevel::ERROR],
            ['length 10', 'prius', LogLevel::NOTICE],
            ['length 10', 'highlander', LogLevel::NOTICE],
            ['length 10', 'rabbit', LogLevel::ERROR],
            ['length 10', 'beetle', LogLevel::ERROR],
            ['length 10', 'jetta', LogLevel::ERROR],
        ]);
    }

}
