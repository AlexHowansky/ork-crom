<?php

/**
 * Ork CROM
 *
 * @package   Ork\Crom
 * @copyright 2021 Alex Howansky (https://github.com/AlexHowansky)
 * @license   https://github.com/AlexHowansky/ork-crom/blob/master/LICENSE MIT License
 * @link      https://github.com/AlexHowansky/ork-crom
 */

namespace Ork\Crom\Scanner;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\Table;
use Generator;
use Ork\Crom\Asset\ColumnAsset;

/**
 * A scanner that iterates over columns.
 */
class ColumnScanner extends AbstractScanner
{

    /**
     * Yield the columns in this database.
     *
     * @return Generator<ColumnAsset> The assets that this scanner produces.
     */
    protected function assetIterator(): Generator
    {
        $tables = $this->getSchemaManager()->listTables();
        uasort($tables, fn(Table $a, Table $b): int => $a->getName() <=> $b->getName());
        foreach ($tables as $table) {
            $columns = $table->getColumns();
            uasort($columns, fn(Column $a, Column $b): int => $a->getName() <=> $b->getName());
            foreach ($columns as $column) {
                $asset = new ColumnAsset($table, $column);
                if ($this->include($asset) === true) {
                    yield $asset;
                }
            }
        }
    }

}
