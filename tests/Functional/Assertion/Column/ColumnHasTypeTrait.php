<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

trait ColumnHasTypeTrait
{

    public function testColumnHasType(): void
    {
        $this->test([
            ['hasTypeInteger', 'colorado', true],
            ['hasTypeInteger', 'utah', false],
            ['hasTypeInteger', 'montana', false],
            ['hasTypeInteger', 'vermont', false],
            ['hasTypeInteger', 'mississippi', false],
            ['hasTypeInteger', 'alabama', false],
            ['hasTypeString', 'colorado', false],
            ['hasTypeString', 'utah', true],
            ['hasTypeString', 'montana', false],
            ['hasTypeString', 'vermont', false],
            ['hasTypeString', 'mississippi', true],
            ['hasTypeString', 'alabama', false],
            ['hasTypeDate', 'colorado', false],
            ['hasTypeDate', 'utah', false],
            ['hasTypeDate', 'montana', true],
            ['hasTypeDate', 'vermont', false],
            ['hasTypeDate', 'mississippi', false],
            ['hasTypeDate', 'alabama', true],
        ]);
    }

}
