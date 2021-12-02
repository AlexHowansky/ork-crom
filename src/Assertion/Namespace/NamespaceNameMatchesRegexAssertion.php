<?php

/**
 * Ork CROM
 *
 * @package   Ork\Crom
 * @copyright 2021 Alex Howansky (https://github.com/AlexHowansky)
 * @license   https://github.com/AlexHowansky/ork-crom/blob/master/LICENSE MIT License
 * @link      https://github.com/AlexHowansky/ork-crom
 */

namespace Ork\Crom\Assertion\Namespace;

use Ork\Crom\Assertion\AbstractNameMatchesRegexAssertion;
use Ork\Crom\Asset\NamespaceAsset;

/**
 * Assertion to verify that a namespace name matches a regular expression.
 */
class NamespaceNameMatchesRegexAssertion extends AbstractNameMatchesRegexAssertion
{

    /**
     * Perform the assertion.
     *
     * @return bool True if the asset passes the assertion.
     */
    protected function assert(NamespaceAsset $asset): bool
    {
        return $this->matchesRegex($asset);
    }

}
