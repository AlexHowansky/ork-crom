<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

trait ColumnIsIndexedTrait
{

    public function testColumnIsIndexed(): void
    {
        $this->test([
            ['isIndexed', 'spaghetti', true],
            ['isIndexed', 'zucchini', false],
            ['isIndexed', 'yellow', false],
            ['isIndexed', 'gourd', true],
        ]);
    }

}
