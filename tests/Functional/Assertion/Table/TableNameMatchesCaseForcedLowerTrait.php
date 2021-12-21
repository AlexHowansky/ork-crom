<?php

namespace Ork\Crom\Tests\Functional\Assertion\Table;

trait TableNameMatchesCaseForcedLowerTrait
{

    public function testTableNameMatchesCase(): void
    {
        $this->test([
            ['macro', 'tomato_can', false],
            ['macro', 'green_bottle', false],
            ['macro', 'logocircle', false],
            ['macro', 'sweetgarden', false],
            ['snake', 'tomato_can', true],
            ['snake', 'green_bottle', true],
            ['snake', 'logocircle', true],
            ['snake', 'sweetgarden', true],
            ['camel', 'tomato_can', false],
            ['camel', 'green_bottle', false],
            ['camel', 'logocircle', true],
            ['camel', 'sweetgarden', true],
        ]);
    }

}
