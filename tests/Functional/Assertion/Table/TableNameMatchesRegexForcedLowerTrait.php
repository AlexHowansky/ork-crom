<?php

namespace Ork\Crom\Tests\Functional\Assertion\Table;

use Psr\Log\LogLevel;

trait TableNameMatchesRegexForcedLowerTrait
{

    public function testTableNameMatchesRegex(): void
    {
        $this->test([
            ['startsWithDragon', 'basilisk', LogLevel::ERROR],
            ['startsWithDragon', 'dragons', LogLevel::ERROR],
            ['startsWithDragon', 'dragon_rider', LogLevel::NOTICE],
            ['startsWithDragon', 'dragon_horde', LogLevel::NOTICE],
            ['noUnderscore', 'basilisk', LogLevel::NOTICE],
            ['noUnderscore', 'dragons', LogLevel::NOTICE],
            ['noUnderscore', 'dragon_rider', LogLevel::ERROR],
            ['noUnderscore', 'dragon_horde', LogLevel::ERROR],
        ]);
    }

}
