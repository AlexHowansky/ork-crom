<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnIsForeignKeyTrait
{

    public function testColumnIsForeignKey(): void
    {
        $this->test([
            ['fkey', 'customer_id', false],
            ['fkey', 'score', false],
            ['fkey', 'state_id', false],
            ['fkey', 'state_name', false],
            ['fkey', 'invoice_id', false],
            ['fkey', 'invoice_customer_id', true],
            ['fkey', 'invoice_state_id', false],
            ['fkey', 'invoice_state_name', false],
            ['fkey', 'total', false],
        ]);
    }

}
