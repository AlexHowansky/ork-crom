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

/**
 * Assertion interface.
 *
 * Assertions should assert one thing. They can take parameters to slightly adjust behavior, but parameters should not
 * be used to enable additional separate checks.
 *
 * Assertions should be named like **`<noun><verb><attribute>`** where **`<noun>`** is the thing being tested. For
 * example:
 *  * `nameIsUppercase`
 *  * `nameMatchesRegex`
 *  * `typeIsInteger`
 *  * `primaryKeyIsNotCompound`
 */
interface AssertionInterface
{

    /**
     * Constructor.
     *
     * @param array<string, mixed> $config The assertion configuration.
     */
    public function __construct(array $config);

    /**
     * Perform the assertion.
     *
     * @param AssetInterface $asset The asset to perform the assertion on.
     *
     * @return void
     *
     * @throws AssertionException If the assertion fails.
     */
    public function __invoke(AssetInterface $asset): void;

    /**
     * Get the configuration for this assertion.
     *
     * @return array<string, mixed> The configuration for this assertion.
     */
    public function getConfig(): array;

    /**
     * Get a label for this assertion.
     *
     * @return string A label for this assertion.
     */
    public function getLabel(): string;

    /**
     * Get a short name for this assertion.
     *
     * @return string A short name for this assertion.
     */
    public function getName(): string;

}
