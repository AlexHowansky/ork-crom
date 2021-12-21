<?php

namespace Ork\Crom\Tests\Functional\Assertion\Table;

trait TableHasPrimaryKeyForcedLowerTrait
{

    public function testTableHasPrimaryKey(): void
    {
        $this->test([
            ['hasPkey', 'willow_popper', true],
            ['hasPkey', 'tower_cube', false],
            ['hasPkey', 'mask_glass', true],
        ]);
    }

}
