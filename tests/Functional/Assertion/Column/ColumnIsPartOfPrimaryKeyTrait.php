<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

trait ColumnIsPartOfPrimaryKeyTrait
{

    public function testColumnIsPartOfPrimaryKey(): void
    {
        $this->test([
            ['isPartOfPkey', 'almond_joy', true],
            ['isPartOfPkey', 'three_musketeers', true],
            ['isPartOfPkey', 'warheads', false],
            ['isPartOfPkey', 'twix', true],
            ['isPartOfPkey', 'necco', false],
        ]);
    }

}
