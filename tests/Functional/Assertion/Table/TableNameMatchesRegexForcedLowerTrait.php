<?php

namespace Ork\Crom\Tests\Functional\Assertion\Table;

trait TableNameMatchesRegexForcedLowerTrait
{

    public function testTableNameMatchesRegex(): void
    {
        $this->test([
            ['startsWithDragon', 'basilisk', false],
            ['startsWithDragon', 'dragons', false],
            ['startsWithDragon', 'dragon_rider', true],
            ['startsWithDragon', 'dragon_horde', true],
            ['noUnderscore', 'basilisk', true],
            ['noUnderscore', 'dragons', true],
            ['noUnderscore', 'dragon_rider', false],
            ['noUnderscore', 'dragon_horde', false],
        ]);
    }

}
