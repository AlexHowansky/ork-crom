<?php

namespace Ork\Crom\Tests\Functional\Assertion\Table;

trait TableHasPrimaryKeyTrait
{

    public function testTableHasPrimaryKey(): void
    {
        $this->test([
            ['hasPkey', 'Willow_Popper', true],
            ['hasPkey', 'Tower_Cube', false],
            ['hasPkey', 'Mask_Glass', true],
        ]);
    }

}
