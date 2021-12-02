<?php

/**
 * Ork CROM
 *
 * @package   Ork\Crom
 * @copyright 2021 Alex Howansky (https://github.com/AlexHowansky)
 * @license   https://github.com/AlexHowansky/ork-crom/blob/master/LICENSE MIT License
 * @link      https://github.com/AlexHowansky/ork-crom
 */

namespace Ork\Crom\Assertion;

use Ork\Crom\Asset\AssetInterface;
use Ork\Crom\Assertion\AbstractAssertion;

/**
 * Abstract assertion to verify that an asset name matches a particular regex.
 */
class AbstractNameMatchesRegexAssertion extends AbstractAssertion
{

    /**
     * Use this configuration field when building the label.
     */
    protected const LABEL_EXTRA_FIELD = 'pattern';

    /**
     * Does an asset name match a particular regex pattern?
     *
     * @param AssetInterface $asset The asset to check the name of.
     *
     * @return bool True if the asset name matches the specified regex pattern.
     */
    protected function matchesRegex(AssetInterface $asset): bool
    {
        return preg_match($this->getRequiredParam('pattern'), $asset->getName()) === 1;
    }

}
