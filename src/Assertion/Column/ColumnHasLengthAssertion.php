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
 * Assertion to verify that a column has a given length.
 */
class ColumnHasLengthAssertion extends AbstractAssertion
{

    /**
     * Use this configuration field when building the label.
     */
    protected const LABEL_EXTRA_FIELD = 'length';

    /**
     * Perform the assertion.
     *
     * @return bool True if the asset passes the assertion.
     */
    protected function assert(ColumnAsset $asset): bool
    {
        return $asset->getColumn()->getLength() === $this->getRequiredParam('length');
    }

}
