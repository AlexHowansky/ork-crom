<?php

namespace Ork\Crom\Tests\Functional\Assertion\Namespace;

use Psr\Log\LogLevel;

trait NamespaceNameMatchesRegexTrait
{

    public function testNamespaceNameMatchesRegex(): void
    {
        $this->test([
            ['beginsWithS', 'mild_cheddar', LogLevel::ERROR],
            ['beginsWithS', 'sharp_cheddar', LogLevel::NOTICE],
            ['beginsWithS', 'gouda', LogLevel::ERROR],
            ['beginsWithS', 'swiss', LogLevel::NOTICE],
            ['endsWithCheddar', 'mild_cheddar', LogLevel::NOTICE],
            ['endsWithCheddar', 'sharp_cheddar', LogLevel::NOTICE],
            ['endsWithCheddar', 'gouda', LogLevel::ERROR],
            ['endsWithCheddar', 'swiss', LogLevel::ERROR],
        ]);
    }

}
