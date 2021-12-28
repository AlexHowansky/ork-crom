<?php

namespace Ork\Crom\Tests\Unit\Assertion\Column;

use Generator;

/**
 * Each record yielded contains three fields:
 * - The name of the column to test against the assertion.
 * - The list of columns to create in the local and foreign tables.
 * - The list of columns to make a foreign key from.
 * - The optional arguments for the assertion.
 */
class ColumnIsForeignKeyAssertionTest extends AbstractColumnAssertionTestCase
{

    public function providerForFail(): Generator
    {
        yield from $this->providerGeneratorForeignKey([

            // No fkey at all.
            ['foo', ['foo'], [], []],

            // Compound fkey.
            ['foo', ['foo', 'bar', 'baz'], ['foo', 'bar'], []],

            // Compound fkey.
            ['bar', ['foo', 'bar', 'baz'], ['foo', 'bar'], []],

            // Single-field fkey to a non-existing table.
            ['foo', ['foo'], ['foo'], ['toTable' => 'bar']],

            // Single-field fkey to an existing table but non-existing column.
            ['foo', ['foo'], ['foo'], ['toTable' => 'foreign', 'toColumn' => 'bar']],

            // Single-field fkey to a non-existing column.
            ['foo', ['foo'], ['foo'], ['toColumn' => 'bar']],

            // Single-field fkey to a non-existing table but existing column.
            ['foo', ['foo'], ['foo'], ['toTable' => 'bar', 'toColumn' => 'foo']],

        ]);
    }

    public function providerForPass(): Generator
    {
        yield from $this->providerGeneratorForeignKey([

            // Single-field fkey in a table with only one field.
            ['foo', ['foo'], ['foo'], []],

            // Single-field fkey in a table with only one field, to a specific table.
            ['foo', ['foo'], ['foo'], ['toTable' => 'foreign']],

            // Single-field fkey in a table with only one field, to a specific column.
            ['foo', ['foo'], ['foo'], ['toColumn' => 'foo']],

            // Single-field fkey in a table with only one field, to a specific table and column.
            ['foo', ['foo'], ['foo'], ['toTable' => 'foreign', 'toColumn' => 'foo']],

            // Single-field fkey in a table with multiple fields.
            ['foo', ['foo', 'bar', 'baz'], ['foo'], []],

            // Single-field fkey in a table with multiple fields, to a specific table.
            ['foo', ['foo', 'bar', 'baz'], ['foo'], ['toTable' => 'foreign']],

            // Single-field fkey in a table with multiple fields, to a specific column.
            ['foo', ['foo', 'bar', 'baz'], ['foo'], ['toColumn' => 'foo']],

            // Single-field fkey in a table with multiple fields, to a specific table and column.
            ['foo', ['foo', 'bar', 'baz'], ['foo'], ['toTable' => 'foreign', 'toColumn' => 'foo']],

        ]);
    }

}
