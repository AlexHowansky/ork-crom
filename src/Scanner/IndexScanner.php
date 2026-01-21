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

use Doctrine\DBAL\Schema\Index;
use Doctrine\DBAL\Schema\Table;
use Generator;
use Ork\Crom\Asset\IndexAsset;

/**
 * A scanner that iterates over indexes.
 */
class IndexScanner extends AbstractScanner
{

    /**
     * Yield the indexes in this database.
     *
     * @return Generator<IndexAsset> The assets that this scanner produces.
     */
    protected function assetIterator(): Generator
    {
        $tables = $this->getSchemaManager()->listTables();
        uasort($tables, fn(Table $a, Table $b): int => $a->getName() <=> $b->getName());
        foreach ($tables as $table) {
            $indexes = $table->getIndexes();
            uasort($indexes, fn(Index $a, Index $b): int => $a->getName() <=> $b->getName());
            foreach ($indexes as $index) {
                $asset = new IndexAsset($table, $index);
                if ($this->include($asset) === true) {
                    yield $asset;
                }
            }
        }
    }

}
