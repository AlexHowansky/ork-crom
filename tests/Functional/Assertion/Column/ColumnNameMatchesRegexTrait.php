<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnNameMatchesRegexTrait
{

    public function testColumnNameMatchesRegex(): void
    {
        $this->test([
            ['underscore', 'azul', false],
            ['underscore', 'terraforming_mars', true],
            ['underscore', 'cosmic_encounter', true],
            ['underscore', 'scythe', false],
            ['short', 'azul', true],
            ['short', 'terraforming_mars', false],
            ['short', 'cosmic_encounter', false],
            ['short', 'scythe', true],
        ]);
    }

}
