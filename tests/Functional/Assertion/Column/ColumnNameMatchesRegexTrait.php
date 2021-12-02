<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnNameMatchesRegexTrait
{

    public function testColumnNameMatchesRegex(): void
    {
        $this->test([
            ['underscore', 'azul', LogLevel::ERROR],
            ['underscore', 'terraforming_mars', LogLevel::NOTICE],
            ['underscore', 'cosmic_encounter', LogLevel::NOTICE],
            ['underscore', 'scythe', LogLevel::ERROR],
            ['short', 'azul', LogLevel::NOTICE],
            ['short', 'terraforming_mars', LogLevel::ERROR],
            ['short', 'cosmic_encounter', LogLevel::ERROR],
            ['short', 'scythe', LogLevel::NOTICE],
        ]);
    }

}
