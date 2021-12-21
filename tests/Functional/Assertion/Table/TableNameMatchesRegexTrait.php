<?php

namespace Ork\Crom\Tests\Functional\Assertion\Table;

trait TableNameMatchesRegexTrait
{

    public function testTableNameMatchesRegex(): void
    {
        $this->test([
            ['startsWithDragon', 'Basilisk', false],
            ['startsWithDragon', 'Dragons', false],
            ['startsWithDragon', 'Dragon_Rider', true],
            ['startsWithDragon', 'DRAGON_HORDE', true],
            ['noUnderscore', 'Basilisk', true],
            ['noUnderscore', 'Dragons', true],
            ['noUnderscore', 'Dragon_Rider', false],
            ['noUnderscore', 'DRAGON_HORDE', false],
        ]);
    }

}
