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
class ColumnIsPartOfForeignKeyAssertionTest extends AbstractColumnAssertionTestCase
{

    public static function providerForFail(): Generator
    {
        yield from static::providerGeneratorForeignKey([

            // No fkey at all.
            ['foo', ['foo'], [], []],

            // Not part of single-field fkey.
            ['bar', ['foo', 'bar', 'baz'], ['foo'], []],

            // Not part of compound fkey.
            ['baz', ['foo', 'bar', 'baz'], ['foo', 'bar'], []],

        ]);
    }

    public static function providerForPass(): Generator
    {
        yield from static::providerGeneratorForeignKey([

            // Part of single-field fkey.
            ['foo', ['foo'], ['foo'], []],

            // Part of compound fkey.
            ['foo', ['foo', 'bar', 'baz'], ['foo', 'bar'], []],

            // Part of compound fkey.
            ['bar', ['foo', 'bar', 'baz'], ['foo', 'bar'], []],

        ]);
    }

}
