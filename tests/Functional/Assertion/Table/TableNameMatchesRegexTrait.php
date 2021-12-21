<?php

namespace Ork\Crom\Tests\Functional\Assertion\Table;

use Psr\Log\LogLevel;

trait TableNameMatchesRegexTrait
{

    public function testTableNameMatchesRegex(): void
    {
        $this->test([
            ['startsWithDragon', 'Basilisk', LogLevel::ERROR],
            ['startsWithDragon', 'Dragons', LogLevel::ERROR],
            ['startsWithDragon', 'Dragon_Rider', LogLevel::NOTICE],
            ['startsWithDragon', 'DRAGON_HORDE', LogLevel::NOTICE],
            ['noUnderscore', 'Basilisk', LogLevel::NOTICE],
            ['noUnderscore', 'Dragons', LogLevel::NOTICE],
            ['noUnderscore', 'Dragon_Rider', LogLevel::ERROR],
            ['noUnderscore', 'DRAGON_HORDE', LogLevel::ERROR],
        ]);
    }

}
