<?php

namespace Ork\Crom\Tests\Functional\Assertion\Namespace;

use Psr\Log\LogLevel;

trait NamespaceNameMatchesRegexTrait
{

    public function testNamespaceNameMatchesRegex(): void
    {
        $this->test([
            ['beginsWithS', 'mild_cheddar', false],
            ['beginsWithS', 'sharp_cheddar', true],
            ['beginsWithS', 'gouda', false],
            ['beginsWithS', 'swiss', true],
            ['endsWithCheddar', 'mild_cheddar', true],
            ['endsWithCheddar', 'sharp_cheddar', true],
            ['endsWithCheddar', 'gouda', false],
            ['endsWithCheddar', 'swiss', false],
        ]);
    }

}
