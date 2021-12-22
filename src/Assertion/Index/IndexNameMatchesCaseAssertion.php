<?php

/**
 * Ork CROM
 *
 * @package   Ork\Crom
 * @copyright 2021 Alex Howansky (https://github.com/AlexHowansky)
 * @license   https://github.com/AlexHowansky/ork-crom/blob/master/LICENSE MIT License
 * @link      https://github.com/AlexHowansky/ork-crom
 */

namespace Ork\Crom\Assertion\Index;

use Ork\Crom\Assertion\AbstractNameMatchesCaseAssertion;
use Ork\Crom\Asset\IndexAsset;

/**
 * Assertion to verify that a index name matches a particular casing strategy.
 */
class IndexNameMatchesCaseAssertion extends AbstractNameMatchesCaseAssertion
{

    /**
     * Perform the assertion.
     *
     * @return bool True if the asset passes the assertion.
     */
    protected function assert(IndexAsset $asset): bool
    {
        return $this->matchesCase($asset);
    }

}
