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
        foreach ($this->getSchemaManager()->listTables() as $table) {
            foreach ($table->getColumns() as $column) {
                $asset = new ColumnAsset($table, $column);
                if ($this->include($asset) === true) {
                    yield $asset;
                }
            }
        }
    }

}
