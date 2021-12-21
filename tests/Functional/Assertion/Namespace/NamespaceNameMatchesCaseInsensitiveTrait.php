<?php

namespace Ork\Crom\Tests\Functional\Assertion\Namespace;

use Psr\Log\LogLevel;

trait NamespaceNameMatchesCaseInsensitiveTrait
{

    public function testNamespaceNameMatchesCase(): void
    {
        $this->test([
            ['macro', 'focal_banger', false],
            ['macro', 'choppin_broccoli', false],
            ['macro', 'lalunarosa', false],
            ['macro', 'bumblefetish', false],
            ['snake', 'focal_banger', true],
            ['snake', 'choppin_broccoli', true],
            ['snake', 'lalunarosa', true],
            ['snake', 'bumblefetish', true],
            ['camel', 'focal_banger', false],
            ['camel', 'choppin_broccoli', false],
            ['camel', 'lalunarosa', true],
            ['camel', 'bumblefetish', true],
        ]);
    }

}
