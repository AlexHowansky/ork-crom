<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnHasLengthTrait
{

    public function testColumnHasLength(): void
    {
        $this->test([
            ['length 10', 'celica', false],
            ['length 10', 'prius', true],
            ['length 10', 'highlander', true],
            ['length 10', 'rabbit', false],
            ['length 10', 'beetle', false],
            ['length 10', 'jetta', false],
        ]);
    }

}
