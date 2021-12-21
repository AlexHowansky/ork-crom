<?php

namespace Ork\Crom\Tests\Functional\Assertion\Namespace;

use Psr\Log\LogLevel;

trait NamespaceNameMatchesCaseSensitiveTrait
{

    public function testNamespaceNameMatchesCase(): void
    {
        $this->test([
            ['macro', 'FOCAL_BANGER', true],
            ['macro', 'choppin_broccoli', false],
            ['macro', 'laLunaRosa', false],
            ['macro', 'BumbleFetish', false],
            ['snake', 'FOCAL_BANGER', false],
            ['snake', 'choppin_broccoli', true],
            ['snake', 'laLunaRosa', false],
            ['snake', 'BumbleFetish', false],
            ['camel', 'FOCAL_BANGER', false],
            ['camel', 'choppin_broccoli', false],
            ['camel', 'laLunaRosa', true],
            ['camel', 'BumbleFetish', false],
        ]);
    }

}
