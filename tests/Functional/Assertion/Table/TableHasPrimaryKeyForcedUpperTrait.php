<?php

namespace Ork\Crom\Tests\Functional\Assertion\Table;

trait TableHasPrimaryKeyForcedUpperTrait
{

    public function testTableHasPrimaryKey(): void
    {
        $this->test([
            ['hasPkey', 'WILLOW_POPPER', true],
            ['hasPkey', 'TOWER_CUBE', false],
            ['hasPkey', 'MASK_GLASS', true],
        ]);
    }

}
