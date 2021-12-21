<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnIsPartOfPrimaryKeyTrait
{

    public function testColumnIsPartOfPrimaryKey(): void
    {
        $this->test([
            ['partOfPkey', 'almond_joy', true],
            ['partOfPkey', 'three_musketeers', true],
            ['partOfPkey', 'warheads', false],
            ['partOfPkey', 'twix', true],
            ['partOfPkey', 'necco', false],
        ]);
    }

}
