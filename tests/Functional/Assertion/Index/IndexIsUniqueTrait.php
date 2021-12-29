<?php

namespace Ork\Crom\Tests\Functional\Assertion\Index;

trait IndexIsUniqueTrait
{

    public function testIndexIsUnique(): void
    {
        $this->test([
            ['indexIsUnique', 'fanta', false],
            ['indexIsUnique', 'polar', true],
        ]);
    }

}
