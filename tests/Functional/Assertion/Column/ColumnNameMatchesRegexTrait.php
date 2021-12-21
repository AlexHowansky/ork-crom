<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

trait ColumnNameMatchesRegexTrait
{

    public function testColumnNameMatchesRegex(): void
    {
        $this->test([
            ['containsUnderscore', 'azul', false],
            ['containsUnderscore', 'terraforming_mars', true],
            ['containsUnderscore', 'cosmic_encounter', true],
            ['containsUnderscore', 'scythe', false],
            ['isShort', 'azul', true],
            ['isShort', 'terraforming_mars', false],
            ['isShort', 'cosmic_encounter', false],
            ['isShort', 'scythe', true],
        ]);
    }

}
