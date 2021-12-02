<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnIsPartOfPrimaryKeyTrait
{

    public function testColumnIsPartOfPrimaryKey(): void
    {
        $this->test([
            ['partOfPkey', 'almond_joy', LogLevel::NOTICE],
            ['partOfPkey', 'three_musketeers', LogLevel::NOTICE],
            ['partOfPkey', 'warheads', LogLevel::ERROR],
            ['partOfPkey', 'twix', LogLevel::NOTICE],
            ['partOfPkey', 'necco', LogLevel::ERROR],
        ]);
    }

}
