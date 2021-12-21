<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnIsPartOfForeignKeyTrait
{

    public function testColumnIsPartOfForeignKey(): void
    {
        $this->test([
            ['isPartOfFkey', 'owner_id', false],
            ['isPartOfFkey', 'age', false],
            ['isPartOfFkey', 'tire_id', false],
            ['isPartOfFkey', 'tire_name', false],
            ['isPartOfFkey', 'car_id', false],
            ['isPartOfFkey', 'car_owner_id', true],
            ['isPartOfFkey', 'car_tire_id', true],
            ['isPartOfFkey', 'car_tire_name', true],
            ['isPartOfFkey', 'spin', false],
        ]);
    }

}
