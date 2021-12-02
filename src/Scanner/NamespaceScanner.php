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
use Ork\Crom\Asset\NamespaceAsset;

/**
 * A scanner that iterates over namespaces.
 */
class NamespaceScanner extends AbstractScanner
{

    /**
     * Yield the namespaces in this database.
     *
     * @return Generator<NamespaceAsset> The assets that this scanner produces.
     */
    protected function assetIterator(): Generator
    {
        foreach ($this->getSchemaManager()->listSchemaNames() as $namespace) {
            $asset = new NamespaceAsset($namespace);
            if ($this->include($asset) === true) {
                yield $asset;
            }
        }
    }

}
