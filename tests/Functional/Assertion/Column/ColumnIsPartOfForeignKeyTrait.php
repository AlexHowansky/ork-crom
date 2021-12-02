<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnIsPartOfForeignKeyTrait
{

    public function testColumnIsPartOfForeignKey(): void
    {
        $this->test([
            ['partOfFkey', 'owner_id', LogLevel::ERROR],
            ['partOfFkey', 'age', LogLevel::ERROR],
            ['partOfFkey', 'tire_id', LogLevel::ERROR],
            ['partOfFkey', 'tire_name', LogLevel::ERROR],
            ['partOfFkey', 'car_id', LogLevel::ERROR],
            ['partOfFkey', 'car_owner_id', LogLevel::NOTICE],
            ['partOfFkey', 'car_tire_id', LogLevel::NOTICE],
            ['partOfFkey', 'car_tire_name', LogLevel::NOTICE],
            ['partOfFkey', 'spin', LogLevel::ERROR],
        ]);
    }

}
