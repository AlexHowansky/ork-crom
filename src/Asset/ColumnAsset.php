<?php

/**
 * Ork CROM
 *
 * @package   Ork\Crom
 * @copyright 2021 Alex Howansky (https://github.com/AlexHowansky)
 * @license   https://github.com/AlexHowansky/ork-crom/blob/master/LICENSE MIT License
 * @link      https://github.com/AlexHowansky/ork-crom
 */

namespace Ork\Crom\Asset;

use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Schema\Table;

/**
 * An asset representing a database column.
 */
class ColumnAsset extends AbstractAsset
{

    /**
     * Constructor.
     *
     * @param Table $table The table this column belongs to.
     * @param Column $column The column this asset represents.
     */
    public function __construct(protected Table $table, protected Column $column)
    {
    }

    /**
     * Get the column this asset represents.
     *
     * @return Column The column this asset represents.
     */
    public function getColumn(): Column
    {
        return $this->column;
    }

    /**
     * Get the label of this asset.
     *
     * @return string The label of this asset.
     */
    public function getLabel(): string
    {
        return sprintf('%s.%s', $this->getTable()->getName(), $this->getName());
    }

    /**
     * Get the name of this asset.
     *
     * @return string The name of this asset.
     */
    public function getName(): string
    {
        return $this->getColumn()->getName();
    }

    /**
     * Get the table this column belongs to.
     *
     * @return Table The table this column belongs to
     */
    public function getTable(): Table
    {
        return $this->table;
    }

}
