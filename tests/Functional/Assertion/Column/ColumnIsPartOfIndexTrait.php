<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

trait ColumnIsPartOfIndexTrait
{

    public function testColumnIsPartOfIndex(): void
    {
        $this->test([
            ['isPartOfIndex', 'spaghetti', true],
            ['isPartOfIndex', 'zucchini', true],
            ['isPartOfIndex', 'yellow', false],
            ['isPartOfIndex', 'gourd', true],
        ]);
    }

}
