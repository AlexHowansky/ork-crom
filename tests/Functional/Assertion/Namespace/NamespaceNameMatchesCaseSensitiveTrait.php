<?php

namespace Ork\Crom\Tests\Functional\Assertion\Namespace;

use Psr\Log\LogLevel;

trait NamespaceNameMatchesCaseSensitiveTrait
{

    public function testNamespaceNameMatchesCase(): void
    {
        $this->test([
            ['macroCase', 'FOCAL_BANGER', true],
            ['macroCase', 'choppin_broccoli', false],
            ['macroCase', 'laLunaRosa', false],
            ['macroCase', 'BumbleFetish', false],
            ['snakeCase', 'FOCAL_BANGER', false],
            ['snakeCase', 'choppin_broccoli', true],
            ['snakeCase', 'laLunaRosa', false],
            ['snakeCase', 'BumbleFetish', false],
            ['camelCase', 'FOCAL_BANGER', false],
            ['camelCase', 'choppin_broccoli', false],
            ['camelCase', 'laLunaRosa', true],
            ['camelCase', 'BumbleFetish', false],
        ]);
    }

}
