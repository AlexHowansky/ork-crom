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

use ReflectionClass;
use RuntimeException;

/**
 * Abstract asset.
 */
abstract class AbstractAsset implements AssetInterface
{

    /**
     * Get the label of this asset.
     *
     * @return string The label of this asset.
     */
    public function getLabel(): string
    {
        return $this->getName();
    }

    /**
     * Get the type of this asset.
     *
     * @return string The type of this asset.
     *
     * @throws RuntimeException If we are unable to determine the asset type.
     */
    public function getType(): string
    {
        return strtolower(
            preg_replace('/Asset$/', '', (new ReflectionClass($this))->getShortName())
                ?? throw new RuntimeException('Unable to determine asset type.')
        );
    }

}
