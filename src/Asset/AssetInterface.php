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

/**
 * Asset interface.
 */
interface AssetInterface
{

    /**
     * Get the label of this asset.
     *
     * @return string The label of this asset.
     */
    public function getLabel(): string;

    /**
     * Get the name of this asset.
     *
     * @return string The name of this asset.
     */
    public function getName(): string;

    /**
     * Get the type of this asset.
     *
     * @return string The type of this asset.
     */
    public function getType(): string;

}
