<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

trait ColumnHasDefaultTrait
{

    public function testColumnHasDefault(): void
    {
        $this->test([
            ['hasAnyDefault', 'spain', true],
            ['hasAnyDefault', 'france', false],
            ['hasAnyDefault', 'vietnam', true],
            ['hasAnyDefault', 'laos', true],
            ['hasZeroDefault', 'spain', true],
            ['hasZeroDefault', 'france', false],
            ['hasZeroDefault', 'vietnam', false],
            ['hasZeroDefault', 'laos', false],
            ['hasFooDefault', 'spain', false],
            ['hasFooDefault', 'france', false],
            ['hasFooDefault', 'vietnam', true],
            ['hasFooDefault', 'laos', false],
        ]);
    }

}
