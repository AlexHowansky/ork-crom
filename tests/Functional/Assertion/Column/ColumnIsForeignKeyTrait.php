<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnIsForeignKeyTrait
{

    public function testColumnIsForeignKey(): void
    {
        $this->test([
            ['isFkey', 'customer_id', false],
            ['isFkey', 'score', false],
            ['isFkey', 'state_id', false],
            ['isFkey', 'state_name', false],
            ['isFkey', 'invoice_id', false],
            ['isFkey', 'invoice_customer_id', true],
            ['isFkey', 'invoice_state_id', false],
            ['isFkey', 'invoice_state_name', false],
            ['isFkey', 'total', false],
        ]);
    }

}
