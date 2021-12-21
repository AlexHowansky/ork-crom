<?php

namespace Ork\Crom\Tests\Functional\Assertion\Table;

trait TableHasPrimaryKeyTrait
{

    public function testTableHasPrimaryKey(): void
    {
        $this->test([
            ['pkey', 'willow_popper', true],
            ['pkey', 'tower_cube', false],
            ['pkey', 'mask_glass', true],
        ]);
    }

}
