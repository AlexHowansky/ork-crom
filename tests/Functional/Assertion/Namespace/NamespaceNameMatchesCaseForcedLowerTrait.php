<?php

namespace Ork\Crom\Tests\Functional\Assertion\Namespace;

trait NamespaceNameMatchesCaseForcedLowerTrait
{

    public function testNamespaceNameMatchesCase(): void
    {
        $this->test([
            ['macroCase', 'focal_banger', false],
            ['macroCase', 'choppin_broccoli', false],
            ['macroCase', 'lalunarosa', false],
            ['macroCase', 'bumblefetish', false],
            ['snakeCase', 'focal_banger', true],
            ['snakeCase', 'choppin_broccoli', true],
            ['snakeCase', 'lalunarosa', true],
            ['snakeCase', 'bumblefetish', true],
            ['camelCase', 'focal_banger', false],
            ['camelCase', 'choppin_broccoli', false],
            ['camelCase', 'lalunarosa', true],
            ['camelCase', 'bumblefetish', true],
        ]);
    }

}
