<?php

namespace Ork\Crom\Tests\Unit\Assertion\Column;

use Generator;

/**
 * Each record yielded contains three fields:
 * - The name of the column to test against the assertion.
 * - The list of columns to create in the table.
 * - The list of columns to make a primary key from.
 */
class ColumnIsPrimaryKeyAssertionTest extends AbstractColumnAssertionTestCase
{

    public static function providerForFail(): Generator
    {
        yield from static::providerGeneratorPrimaryKey([
            ['foo', ['foo'], []],
            ['foo', ['foo', 'bar'], []],
            ['bar', ['foo', 'bar'], []],
            ['foo', ['foo', 'bar'], ['bar']],
            ['foo', ['foo', 'bar', 'baz'], ['foo', 'bar']],
            ['bar', ['foo', 'bar', 'baz'], ['foo', 'bar']],
            ['foo', ['foo', 'bar', 'baz'], ['bar', 'baz']],
            ['bar', ['foo', 'bar', 'baz'], ['bar', 'baz']],
        ]);
    }

    public static function providerForPass(): Generator
    {
        yield from static::providerGeneratorPrimaryKey([
            ['foo', ['foo'], ['foo']],
            ['foo', ['foo', 'bar'], ['foo']],
            ['bar', ['foo', 'bar'], ['bar']],
            ['foo', ['foo', 'bar', 'baz'], ['foo']],
        ]);
    }

}
