<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

trait ColumnHasLengthAtLeastTrait
{

    public function testColumnHasLengthAtLeast(): void
    {
        $this->test([
            ['hasLengthAtLeast32', 'ranger', false],
            ['hasLengthAtLeast32', 'wagoneer', false],
            ['hasLengthAtLeast32', 'cherokee', true],
            ['hasLengthAtLeast32', 'ram', true],
            ['hasLengthAtLeast32', 'silverado', true],
        ]);
    }

}
