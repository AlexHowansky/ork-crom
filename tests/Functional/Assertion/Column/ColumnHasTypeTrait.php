<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnHasTypeTrait
{

    public function testColumnHasType(): void
    {
        $this->test([
            ['integer', 'colorado', LogLevel::NOTICE],
            ['integer', 'utah', LogLevel::ERROR],
            ['integer', 'montana', LogLevel::ERROR],
            ['integer', 'vermont', LogLevel::ERROR],
            ['integer', 'mississippi', LogLevel::ERROR],
            ['integer', 'alabama', LogLevel::ERROR],
            ['string', 'colorado', LogLevel::ERROR],
            ['string', 'utah', LogLevel::NOTICE],
            ['string', 'montana', LogLevel::ERROR],
            ['string', 'vermont', LogLevel::ERROR],
            ['string', 'mississippi', LogLevel::NOTICE],
            ['string', 'alabama', LogLevel::ERROR],
            ['date', 'colorado', LogLevel::ERROR],
            ['date', 'utah', LogLevel::ERROR],
            ['date', 'montana', LogLevel::NOTICE],
            ['date', 'vermont', LogLevel::ERROR],
            ['date', 'mississippi', LogLevel::ERROR],
            ['date', 'alabama', LogLevel::ERROR],
        ]);
    }

}
