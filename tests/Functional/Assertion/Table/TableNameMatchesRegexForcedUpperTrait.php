<?php

namespace Ork\Crom\Tests\Functional\Assertion\Table;

trait TableNameMatchesRegexForcedUpperTrait
{

    public function testTableNameMatchesRegex(): void
    {
        $this->test([
            ['startsWithDragon', 'BASILISK', false],
            ['startsWithDragon', 'DRAGONS', false],
            ['startsWithDragon', 'DRAGON_RIDER', true],
            ['startsWithDragon', 'DRAGON_HORDE', true],
            ['noUnderscore', 'BASILISK', true],
            ['noUnderscore', 'DRAGONS', true],
            ['noUnderscore', 'DRAGON_RIDER', false],
            ['noUnderscore', 'DRAGON_HORDE', false],
        ]);
    }

}
