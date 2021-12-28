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

use LogicException;
use Ork\Crom\Asset\AssetInterface;
use ReflectionClass;
use RuntimeException;
use TypeError;

/**
 * Assertion abstract for common functionality.
 *
 * @phpcs:ignore
 * @method bool assert(AssetInterface $asset)
 */
abstract class AbstractAssertion implements AssertionInterface
{

    /**
     * Use this configuration field when building the label.
     */
    protected const LABEL_EXTRA_FIELD = null;

    /**
     * Constructor.
     *
     * @param array<string, mixed> $config The assertion configuration.
     */
    public function __construct(protected array $config)
    {
    }

    /**
     * Perform the assertion.
     *
     * @param AssetInterface $asset The asset to perform the assertion on.
     *
     * @throws AssertionException If the assertion fails.
     * @throws LogicException If the assertion class has no assert() method.
     * @throws TypeError If the concrete assertion is passed an asset type that it does not support.
     */
    public function __invoke(AssetInterface $asset): void
    {
        /**
         * Ideally, in order to ensure that the assert() method exists, we would declare an abstract signature:
         *     abstract protected function assert(AssetInterface $asset): bool;
         *
         * However, different assertions work with different types of assets, and PHP doesn't allow us to declare the
         * concretion with a narrower scope than the abstract:
         *     protected function assert(TableAsset $asset): bool { ... }
         *
         * Since we're relying on the type hinting of that assert() argument to provide runtime validation of which
         * assertions support which types of assets, we'll have to do an explicit check for the assert() method here.
         */
        if (method_exists($this, 'assert') === false) {
            throw new LogicException(sprintf('Assertion class %s does not have an assert() method.', $this::class));
        }

        try {
            if ($this->assert($asset) === $this->getOptionalParam('invert', false)) {
                throw new AssertionException($this, $asset);
            }
        } catch (TypeError) {
            throw new TypeError(
                sprintf(
                    'Assertion "%s" does not support asset type "%s"',
                    $this->getName(),
                    $asset->getType()
                )
            );
        }
    }

    /**
     * Get the configuration for this assertion.
     *
     * @return array<string, mixed> The configuration for this assertion.
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * Get a label for this assertion.
     *
     * @return string A label for this assertion.
     */
    public function getLabel(): string
    {
        return sprintf(
            '%s%s%s',
            $this->getOptionalParam('invert', false) === true ? 'NOT ' : '',
            $this->getName(),
            static::LABEL_EXTRA_FIELD === null ? '' : (' ' . $this->getOptionalParam(static::LABEL_EXTRA_FIELD))
        );
    }

    /**
     * Get a short name for this assertion.
     *
     * @return string A short name for this assertion.
     */
    public function getName(): string
    {
        return lcfirst((string) preg_replace('/Assertion$/', '', (new ReflectionClass($this))->getShortName()));
    }

    /**
     * Get an optional configuration parameter.
     *
     * @param string $name The configuration parameter to get.
     * @param mixed $default If no value is available, use this default instead.
     *
     * @return mixed The configuration value.
     */
    protected function getOptionalParam(string $name, mixed $default = null): mixed
    {
        return $this->getConfig()[$name] ?? $default;
    }

    /**
     * Get a required configuration parameter.
     *
     * @param string $name The configuration parameter to get.
     *
     * @return mixed The configuration value.
     *
     * @throws RuntimeException If the parameter is missing.
     */
    protected function getRequiredParam(string $name): mixed
    {
        return $this->getConfig()[$name] ??
            throw new RuntimeException(sprintf('Assertion "%s" requires parameter "%s"', $this->getName(), $name));
    }

}
