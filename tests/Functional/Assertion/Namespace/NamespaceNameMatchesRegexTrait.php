<?php

namespace Ork\Crom\Tests\Functional\Assertion\Namespace;

trait NamespaceNameMatchesRegexTrait
{

    public function testNamespaceNameMatchesRegex(): void
    {
        $this->test([
            ['beginsWithS', 'Mild_Cheddar', false],
            ['beginsWithS', 'Sharp_Cheddar', true],
            ['beginsWithS', 'Gouda', false],
            ['beginsWithS', 'Swiss', true],
            ['endsWithCheddar', 'Mild_Cheddar', true],
            ['endsWithCheddar', 'Sharp_Cheddar', true],
            ['endsWithCheddar', 'Gouda', false],
            ['endsWithCheddar', 'Swiss', false],
        ]);
    }

}
