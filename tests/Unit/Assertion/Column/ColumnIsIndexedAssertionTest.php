<?php

namespace Ork\Crom\Tests\Unit\Assertion\Column;

use Generator;

/**
 * Each record yielded contains three fields:
 * - The name of the column to test against the assertion.
 * - The list of columns to create in the table.
 * - The list of columns to make an index from.
 */
class ColumnIsIndexedAssertionTest extends AbstractColumnAssertionTestCase
{

    public function providerForFail(): Generator
    {
        yield from $this->providerGeneratorIndexed([
            ['foo', ['foo', 'bar', 'baz'], []],
            ['foo', ['foo', 'bar', 'baz'], ['bar']],
            ['foo', ['foo', 'bar', 'baz'], ['bar', 'foo']],
        ]);
    }

    public function providerForPass(): Generator
    {
        yield from $this->providerGeneratorIndexed([
            ['foo', ['foo', 'bar', 'baz'], ['foo']],
            ['foo', ['foo', 'bar', 'baz'], ['foo', 'bar']],
            ['foo', ['foo', 'bar', 'baz'], ['foo', 'bar', 'baz']],
        ]);
    }

}
