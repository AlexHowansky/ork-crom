<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnHasTypeTrait
{

    public function testColumnHasType(): void
    {
        $this->test([
            ['integer', 'colorado', true],
            ['integer', 'utah', false],
            ['integer', 'montana', false],
            ['integer', 'vermont', false],
            ['integer', 'mississippi', false],
            ['integer', 'alabama', false],
            ['string', 'colorado', false],
            ['string', 'utah', true],
            ['string', 'montana', false],
            ['string', 'vermont', false],
            ['string', 'mississippi', true],
            ['string', 'alabama', false],
            ['date', 'colorado', false],
            ['date', 'utah', false],
            ['date', 'montana', true],
            ['date', 'vermont', false],
            ['date', 'mississippi', false],
            ['date', 'alabama', false],
        ]);
    }

}
