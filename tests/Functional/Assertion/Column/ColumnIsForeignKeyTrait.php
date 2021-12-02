<?php

namespace Ork\Crom\Tests\Functional\Assertion\Column;

use Psr\Log\LogLevel;

trait ColumnIsForeignKeyTrait
{

    public function testColumnIsForeignKey(): void
    {
        $this->test([
            ['fkey', 'customer_id', LogLevel::ERROR],
            ['fkey', 'score', LogLevel::ERROR],
            ['fkey', 'state_id', LogLevel::ERROR],
            ['fkey', 'state_name', LogLevel::ERROR],
            ['fkey', 'invoice_id', LogLevel::ERROR],
            ['fkey', 'invoice_customer_id', LogLevel::NOTICE],
            ['fkey', 'invoice_state_id', LogLevel::ERROR],
            ['fkey', 'invoice_state_name', LogLevel::ERROR],
            ['fkey', 'total', LogLevel::ERROR],
        ]);
    }

}
