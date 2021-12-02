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

use Jawira\CaseConverter\Convert;
use Jawira\CaseConverter\CaseConverterException;
use Ork\Crom\Assertion\AbstractAssertion;
use Ork\Crom\Asset\AssetInterface;
use RuntimeException;

/**
 * Abstract assertion to verify that an asset name matches a particular casing strategy.
 */
class AbstractNameMatchesCaseAssertion extends AbstractAssertion
{

    /**
     * Use this configuration field when building the label.
     */
    protected const LABEL_EXTRA_FIELD = 'strategy';

    /**
     * Does an asset name match a particular casing strategy?
     *
     * @param AssetInterface $asset The asset to check the name of.
     *
     * @return bool True if the asset name matches the specified casing strategy.
     *
     * @throws RuntimeException If an unknown casing strategy is requested.
     */
    protected function matchesCase(AssetInterface $asset): bool
    {
        $convert = new Convert($asset->getName());
        $class = 'to' . ucfirst(strtolower($this->getRequiredParam('strategy')));
        try {
            return $asset->getName() === $convert->$class();
        } catch (CaseConverterException) {
            throw new RuntimeException('Unknown casing strategy: ' . $this->getRequiredParam('strategy'));
        }
    }

}
