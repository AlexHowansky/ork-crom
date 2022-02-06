<?php

namespace Ork\Crom\Tests\Functional\Assertion\Table;

trait TableHasIndexTrait
{

    public function testTableHasIndex(): void
    {
        $this->test([
            ['hasIndex', 'Sheer_Orc', false],
            ['hasIndex', 'Elven_Twig', true],
            ['hasIndex', 'Emerald_Ring', true],
        ]);
    }

}
