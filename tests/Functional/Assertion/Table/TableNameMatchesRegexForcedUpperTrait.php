<?php

namespace Ork\Crom\Tests\Functional\Assertion\Table;

use Psr\Log\LogLevel;

trait TableNameMatchesRegexForcedUpperTrait
{

    public function testTableNameMatchesRegex(): void
    {
        $this->test([
            ['startsWithDragon', 'BASILISK', LogLevel::ERROR],
            ['startsWithDragon', 'DRAGONS', LogLevel::ERROR],
            ['startsWithDragon', 'DRAGON_RIDER', LogLevel::NOTICE],
            ['startsWithDragon', 'DRAGON_HORDE', LogLevel::NOTICE],
            ['noUnderscore', 'BASILISK', LogLevel::NOTICE],
            ['noUnderscore', 'DRAGONS', LogLevel::NOTICE],
            ['noUnderscore', 'DRAGON_RIDER', LogLevel::ERROR],
            ['noUnderscore', 'DRAGON_HORDE', LogLevel::ERROR],
        ]);
    }

}
