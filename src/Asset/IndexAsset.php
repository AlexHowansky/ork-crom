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

use Doctrine\DBAL\Schema\Index;
use Doctrine\DBAL\Schema\Table;

/**
 * An asset representing a database index.
 */
class IndexAsset extends AbstractAsset
{

    /**
     * Constructor.
     *
     * @param Table $table The table this index belongs to.
     * @param Index $index The index this asset represents.
     */
    public function __construct(protected Table $table, protected Index $index)
    {
    }

    /**
     * Get the index this asset represents.
     *
     * @return Index The index this asset represents.
     */
    public function getIndex(): Index
    {
        return $this->index;
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
        return $this->getIndex()->getName();
    }

    /**
     * Get the table this index belongs to.
     *
     * @return Table The table this index belongs to
     */
    public function getTable(): Table
    {
        return $this->table;
    }

}
