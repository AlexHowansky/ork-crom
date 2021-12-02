<?php

namespace Ork\Crom\Tests\Functional\Assertion\Namespace;

use Psr\Log\LogLevel;

trait NamespaceNameMatchesCaseSensitiveTrait
{

    public function testNamespaceNameMatchesCase(): void
    {
        $this->test([
            ['macro', 'FOCAL_BANGER', LogLevel::NOTICE],
            ['macro', 'choppin_broccoli', LogLevel::ERROR],
            ['macro', 'laLunaRosa', LogLevel::ERROR],
            ['macro', 'BumbleFetish', LogLevel::ERROR],
            ['snake', 'FOCAL_BANGER', LogLevel::ERROR],
            ['snake', 'choppin_broccoli', LogLevel::NOTICE],
            ['snake', 'laLunaRosa', LogLevel::ERROR],
            ['snake', 'BumbleFetish', LogLevel::ERROR],
            ['camel', 'FOCAL_BANGER', LogLevel::ERROR],
            ['camel', 'choppin_broccoli', LogLevel::ERROR],
            ['camel', 'laLunaRosa', LogLevel::NOTICE],
            ['camel', 'BumbleFetish', LogLevel::ERROR],
        ]);
    }

}
