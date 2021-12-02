<?php

namespace Ork\Crom\Tests\Functional\Assertion\Namespace;

use Psr\Log\LogLevel;

trait NamespaceNameMatchesCaseInsensitiveTrait
{

    public function testNamespaceNameMatchesCase(): void
    {
        $this->test([
            ['macro', 'focal_banger', LogLevel::ERROR],
            ['macro', 'choppin_broccoli', LogLevel::ERROR],
            ['macro', 'lalunarosa', LogLevel::ERROR],
            ['macro', 'bumblefetish', LogLevel::ERROR],
            ['snake', 'focal_banger', LogLevel::NOTICE],
            ['snake', 'choppin_broccoli', LogLevel::NOTICE],
            ['snake', 'lalunarosa', LogLevel::NOTICE],
            ['snake', 'bumblefetish', LogLevel::NOTICE],
            ['camel', 'focal_banger', LogLevel::ERROR],
            ['camel', 'choppin_broccoli', LogLevel::ERROR],
            ['camel', 'lalunarosa', LogLevel::NOTICE],
            ['camel', 'bumblefetish', LogLevel::NOTICE],
        ]);
    }

}
