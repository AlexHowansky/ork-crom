<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnIsPartOfForeignKeyTrait
{

    public function testColumnIsPartOfForeignKey(): void
    {
        $this->test([
            ['partOfFkey', 'owner_id', false],
            ['partOfFkey', 'age', false],
            ['partOfFkey', 'tire_id', false],
            ['partOfFkey', 'tire_name', false],
            ['partOfFkey', 'car_id', false],
            ['partOfFkey', 'car_owner_id', true],
            ['partOfFkey', 'car_tire_id', true],
            ['partOfFkey', 'car_tire_name', true],
            ['partOfFkey', 'spin', false],
        ]);
    }

}
