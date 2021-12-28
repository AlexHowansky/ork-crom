<?php

/**
 * Ork CROM
 *
 * @package   Ork\Crom
 * @copyright 2021 Alex Howansky (https://github.com/AlexHowansky)
 * @license   https://github.com/AlexHowansky/ork-crom/blob/master/LICENSE MIT License
 * @link      https://github.com/AlexHowansky/ork-crom
 */

namespace Ork\Crom\Assertion\Column;

use Ork\Crom\Assertion\AbstractAssertion;
use Ork\Crom\Asset\ColumnAsset;

/**
 * Assertion to verify that a column is a foreign key.
 */
class ColumnIsForeignKeyAssertion extends AbstractAssertion
{

    /**
     * Perform the assertion.
     *
     * @return bool True if the asset passes the assertion.
     */
    protected function assert(ColumnAsset $asset): bool
    {
        foreach ($asset->getTable()->getForeignKeys() as $fkey) {
            if ($fkey->getLocalColumns() === [$asset->getColumn()->getName()]) {
                $foreignTable = $fkey->getForeignTableName();
                if ($this->getOptionalParam('toTable', $foreignTable) !== $foreignTable) {
                    continue;
                }
                $foreignColumns = $fkey->getForeignColumns();
                if (in_array($this->getOptionalParam('toColumn', $foreignColumns[0]), $foreignColumns) === false) {
                    continue;
                }
                return true;
            }
        }
        return false;
    }

}
