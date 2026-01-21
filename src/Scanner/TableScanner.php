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

use Doctrine\DBAL\Schema\Table;
use Generator;
use Ork\Crom\Asset\TableAsset;

/**
 * A scanner that iterates over tables.
 */
class TableScanner extends AbstractScanner
{

    /**
     * Yield the tables in this database.
     *
     * @return Generator<TableAsset> The assets that this scanner produces.
     */
    protected function assetIterator(): Generator
    {
        $tables = $this->getSchemaManager()->listTables();
        uasort($tables, fn(Table $a, Table $b): int => $a->getName() <=> $b->getName());
        foreach ($tables as $table) {
            $asset = new TableAsset($table);
            if ($this->include($asset) === true) {
                yield $asset;
            }
        }
    }

}
