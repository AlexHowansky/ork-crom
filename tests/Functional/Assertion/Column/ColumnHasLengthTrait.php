<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnHasLengthTrait
{

    public function testColumnHasLength(): void
    {
        $this->test([
            ['hasLength10', 'celica', false],
            ['hasLength10', 'prius', true],
            ['hasLength10', 'highlander', true],
            ['hasLength10', 'rabbit', false],
            ['hasLength10', 'beetle', false],
            ['hasLength10', 'jetta', false],
        ]);
    }

}
