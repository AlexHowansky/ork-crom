<?php

namespace Ork\Crom\Tests\Functional\Assertion\Namespace;

trait NamespaceNameMatchesCaseForcedUpperTrait
{

    public function testNamespaceNameMatchesCase(): void
    {
        $this->test([
            ['macroCase', 'FOCAL_BANGER', true],
            ['macroCase', 'CHOPPIN_BROCCOLI', true],
            ['macroCase', 'LALUNAROSA', true],
            ['macroCase', 'BUMBLEFETISH', true],
            ['snakeCase', 'FOCAL_BANGER', false],
            ['snakeCase', 'CHOPPIN_BROCCOLI', false],
            ['snakeCase', 'LALUNAROSA', false],
            ['snakeCase', 'BUMBLEFETISH', false],
            ['camelCase', 'FOCAL_BANGER', false],
            ['camelCase', 'CHOPPIN_BROCCOLI', false],
            ['camelCase', 'LALUNAROSA', false],
            ['camelCase', 'BUMBLEFETISH', false],
        ]);
    }

}
