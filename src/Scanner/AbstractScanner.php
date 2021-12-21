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

use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Generator;
use Ork\Crom\Assertion\AssertionException;
use Ork\Crom\Assertion\AssertionInterface;
use Ork\Crom\Asset\AssetInterface;
use Ork\Crom\Progress\ProgressInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use ReflectionClass;
use RuntimeException;

/**
 * Abstract scanner.
 */
abstract class AbstractScanner implements ScannerInterface
{

    public const LOG_LEVEL_FAIL = LogLevel::ERROR;
    public const LOG_LEVEL_PASS = LogLevel::NOTICE;

    /**
     * Constructor.
     *
     * @param array<string, mixed> $config The configuration for this scanner.
     * @param ProgressInterface $progress The progress tracker.
     * @param LoggerInterface $logger A PSR-3 logger that we can use.
     * @param AbstractSchemaManager $schemaManager The Doctrine schema manager.
     */
    public function __construct(
        protected array $config,
        protected ProgressInterface $progress,
        protected LoggerInterface $logger,
        protected AbstractSchemaManager $schemaManager
    ) {
    }

    /**
     * Invocation wrapper.
     */
    public function __invoke(): void
    {
        $this->getLogger()->info(sprintf('launching %s scanner', $this->getName()), $this->config);
        foreach ($this->assetIterator() as $asset) {
            $this->scanAsset($asset);
        }
    }

    /**
     * Yield the assertions for this scanner.
     *
     * @return Generator<AssertionInterface> The assertions for this scanner.
     */
    protected function assertionIterator(): Generator
    {
        foreach ($this->getConfig('assertions') as $assertionConfig) {
            yield $this->getAssertion($assertionConfig);
        }
    }

    /**
     * Yield the assets that this scanner produces.
     *
     * @return Generator<AssetInterface> The assets that this scanner produces.
     */
    abstract protected function assetIterator(): Generator;

    /**
     * Instantiate an assertion from a config block.
     *
     * @param array<string, mixed> $assertionConfig The assertion configuration block.
     *
     * @return AssertionInterface The instantiated assertion.
     *
     * @throws RuntimeException On error.
     */
    protected function getAssertion(array $assertionConfig): AssertionInterface
    {
        static $assertionInterface = null;
        if ($assertionInterface === null) {
            $assertionInterface = (new ReflectionClass(AssertionInterface::class));
        }
        if (array_key_exists('assertion', $assertionConfig) === false) {
            throw new RuntimeException('Configuration is missing assertion');
        }
        $className = sprintf(
            '%s\%s\%sAssertion',
            $assertionInterface->getNamespaceName(),
            ucfirst($this->getName()),
            ucfirst($assertionConfig['assertion'])
        );
        if (class_exists($className) === false) {
            throw new RuntimeException(
                sprintf(
                    'Configuration refers to unknown assertion "%s" for scanner "%s"',
                    $assertionConfig['assertion'],
                    $this->getName()
                )
            );
        }
        unset($assertionConfig['assertion']);

        /**
         * PHPStan complains here because it's not satisfied that the class
         * we're about to return implements AssertionInterface. We've ensured
         * that sufficiently via the manner in which the name is built, so an
         * additional instanceof check here would be redundant, given that the
         * return typehint is already doing that runtime check for us.
         *
         * @phpstan-ignore-next-line
         */
        return new $className($assertionConfig, $this);
    }

    /**
     * Get a configuration section.
     *
     * @return array<string, mixed>
     */
    protected function getConfig(string $section): array
    {
        return $this->config[$section] ?? [];
    }

    /**
     * Get a label for this scanner.
     *
     * @return string A label for this scanner.
     */
    public function getLabel(): string
    {
        return $this->config['label'] ?? $this->getName();
    }

    /**
     * Get the logger.
     *
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    /**
     * Get a short name for this scanner.
     *
     * @return string A short name for this scanner.
     */
    public function getName(): string
    {
        return lcfirst((string) preg_replace('/Scanner$/', '', (new ReflectionClass($this))->getShortName()));
    }

    /**
     * Get the progress tracker.
     *
     * @return ProgressInterface The progress tracker.
     */
    public function getProgress(): ProgressInterface
    {
        return $this->progress;
    }

    /**
     * Get the schema manager.
     *
     * @return AbstractSchemaManager
     */
    public function getSchemaManager(): AbstractSchemaManager
    {
        return $this->schemaManager;
    }

    /**
     * Determine if we should include an asset based on optional assertion filters.
     *
     * @param AssetInterface $asset The asset to check.
     *
     * @return bool True if we should yield the asset.
     */
    protected function include(AssetInterface $asset): bool
    {
        foreach ($this->getConfig('include') as $assertionConfig) {
            try {
                ($this->getAssertion($assertionConfig))($asset);
            } catch (AssertionException) {
                return false;
            }
        }
        return true;
    }

    /**
     * Scan an asset.
     */
    protected function scanAsset(AssetInterface $asset): void
    {
        $this->getLogger()->info(sprintf('scanning %s asset "%s"', $asset->getType(), $asset->getLabel()));
        foreach ($this->assertionIterator() as $assertion) {
            try {
                $this->getLogger()->debug(
                    sprintf(
                        'launching %s assertion on %s asset "%s"',
                        $assertion->getName(),
                        $asset->getType(),
                        $asset->getLabel()
                    ),
                    [
                        'scanner' => $this,
                        'asset' => $asset,
                        'assertion' => $assertion,
                    ]
                );
                $assertion($asset);
                $this->getProgress()->pass($this, $asset, $assertion);
                $this->getLogger()->log(
                    self::LOG_LEVEL_PASS,
                    sprintf(
                        '%s asset "%s" passed assertion %s',
                        $this->getName(),
                        $asset->getLabel(),
                        $assertion->getName()
                    ),
                    [
                        'scanner' => $this,
                        'asset' => $asset,
                        'assertion' => $assertion,
                    ]
                );
            } catch (AssertionException $e) {
                $this->getProgress()->fail($this, $asset, $assertion);
                $this->getLogger()->log(
                    self::LOG_LEVEL_FAIL,
                    sprintf(
                        '%s asset "%s" failed assertion %s',
                        $this->getName(),
                        $asset->getLabel(),
                        $assertion->getName()
                    ),
                    [
                        'scanner' => $this,
                        'asset' => $asset,
                        'assertion' => $assertion,
                    ]
                );
            }
        }
    }

}
