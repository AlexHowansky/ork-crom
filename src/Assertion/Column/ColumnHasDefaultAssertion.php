<?php

/**
 * Ork CROM
 *
 * @package   Ork\Crom
 * @copyright 2021 Alex Howansky (https://github.com/AlexHowansky)
 * @license   https://github.com/AlexHowansky/ork-crom/blob/master/LICENSE MIT License
 * @link      https://github.com/AlexHowansky/ork-crom
 */

namespace Ork\Crom\Assertion\Column;

use Ork\Crom\Assertion\AbstractAssertion;
use Ork\Crom\Asset\ColumnAsset;

/**
 * Assertion to verify that a column has a default value.
 */
class ColumnHasDefaultAssertion extends AbstractAssertion
{

    /**
     * Use this configuration field when building the label.
     */
    protected const LABEL_EXTRA_FIELD = 'value';

    /**
     * Perform the assertion.
     *
     * @return bool True if the asset passes the assertion.
     */
    protected function assert(ColumnAsset $asset): bool
    {
        $actualDefault = $asset->getColumn()->getDefault();
        $expectedDefault = $this->getOptionalParam('value');
        if ($expectedDefault === null) {
            return $actualDefault !== null;
        }
        return $actualDefault !== null && $actualDefault == $expectedDefault;
    }

}
