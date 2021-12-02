<?php

namespace Ork\Crom\Tests\Unit\Assertion\Column;

use Generator;

/**
 * Each record yielded contains three fields:
 * - The name of the column to test against the assertion.
 * - The list of columns to create in the local and foreign tables.
 * - The list of columns to make a foreign key from.
 */
class ColumnIsForeignKeyAssertionTest extends AbstractColumnAssertionTestCase
{

    public function providerForFail(): Generator
    {
        yield from $this->providerGeneratorForeignKey([

            // No fkey at all.
            ['foo', ['foo'], []],

            // Compound fkey.
            ['foo', ['foo', 'bar', 'baz'], ['foo', 'bar']],

            // Compound fkey.
            ['bar', ['foo', 'bar', 'baz'], ['foo', 'bar']],

        ]);
    }

    public function providerForPass(): Generator
    {
        yield from $this->providerGeneratorForeignKey([

            // Single-field fkey in a table with only one field.
            ['foo', ['foo'], ['foo']],

            // Single-field fkey in a table with multiple fields.
            ['foo', ['foo', 'bar', 'baz'], ['foo']],

        ]);
    }

}
