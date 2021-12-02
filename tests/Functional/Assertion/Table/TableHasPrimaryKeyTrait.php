<?php

namespace Ork\Crom\Tests\Functional\Assertion\Table;

use Psr\Log\LogLevel;

trait TableHasPrimaryKeyTrait
{

    public function testTableHasPrimaryKey(): void
    {
        $this->test([
            ['pkey', 'willow_popper', LogLevel::NOTICE],
            ['pkey', 'tower_cube', LogLevel::ERROR],
            ['pkey', 'mask_glass', LogLevel::NOTICE],
        ]);
    }

}
