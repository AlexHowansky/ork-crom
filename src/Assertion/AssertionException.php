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
use RuntimeException;

/**
 * Exception for assertion failures.
 */
class AssertionException extends RuntimeException
{

    /**
     * Constructor.
     *
     * @param AssertionInterface $assertion The assertion that raised the exception.
     * @param AssetInterface $asset That asset that was being scanned.
     */
    public function __construct(protected AssertionInterface $assertion, protected AssetInterface $asset)
    {
        parent::__construct(
            sprintf(
                '%s asset "%s" failed assertion "%s"',
                $asset->getType(),
                $asset->getName(),
                $assertion->getName()
            )
        );
    }

    /**
     * Get the assertion that triggered this exception.
     *
     * @return AssertionInterface The assertion that triggered this exception.
     */
    public function getAssertion(): AssertionInterface
    {
        return $this->assertion;
    }

    /**
     * Get the asset that trigged this exception.
     *
     * @return AssetInterface The asset that trigged this exception.
     */
    public function getAsset(): AssetInterface
    {
        return $this->asset;
    }

}
