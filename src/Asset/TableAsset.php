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

use Doctrine\DBAL\Schema\Table;

/**
 * An asset representing a database table.
 */
class TableAsset extends AbstractAsset
{

    /**
     * Constructor.
     *
     * @param Table $table The table this asset represents.
     */
    public function __construct(protected Table $table)
    {
    }

    /**
     * Get the name of this asset.
     *
     * @return string The name of this asset.
     */
    public function getName(): string
    {
        return $this->getTable()->getName();
    }

    /**
     * Get the table this asset represents.
     *
     * @return Table The table this asset represents.
     */
    public function getTable(): Table
    {
        return $this->table;
    }

}
