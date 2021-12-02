<?php

namespace Ork\Crom\Tests\Functional\Assertion\Table;

use Psr\Log\LogLevel;

trait TableNameMatchesRegexTrait
{

    public function testTableNameMatchesRegex(): void
    {
        $this->test([
            ['dragon', 'basilisk', LogLevel::ERROR],
            ['dragon', 'dragons', LogLevel::ERROR],
            ['dragon', 'dragon_rider', LogLevel::NOTICE],
            ['dragon', 'dragon_horde', LogLevel::NOTICE],
            ['nodash', 'basilisk', LogLevel::NOTICE],
            ['nodash', 'dragons', LogLevel::NOTICE],
            ['nodash', 'dragon_rider', LogLevel::ERROR],
            ['nodash', 'dragon_horde', LogLevel::ERROR],
        ]);
    }

}
