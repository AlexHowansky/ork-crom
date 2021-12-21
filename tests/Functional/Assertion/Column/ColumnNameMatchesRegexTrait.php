<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

trait ColumnNameMatchesRegexTrait
{

    public function testColumnNameMatchesRegex(): void
    {
        $this->test([
            ['containsUnderscore', 'Azul', false],
            ['containsUnderscore', 'Terraforming_Mars', true],
            ['containsUnderscore', 'Cosmic_Encounter', true],
            ['containsUnderscore', 'Scythe', false],
            ['isShort', 'Azul', true],
            ['isShort', 'Terraforming_Mars', false],
            ['isShort', 'Cosmic_Encounter', false],
            ['isShort', 'Scythe', true],
        ]);
    }

}
