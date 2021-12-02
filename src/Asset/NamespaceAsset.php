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
 * A asset representing a database namespace.
 */
class NamespaceAsset extends AbstractAsset
{

    /**
     * Constructor.
     *
     * @param string $namespace The namespace this asset represents.
     */
    public function __construct(protected string $namespace)
    {
    }

    /**
     * Get the name of this asset.
     *
     * @return string The name of this asset.
     */
    public function getName(): string
    {
        return $this->namespace;
    }

}
