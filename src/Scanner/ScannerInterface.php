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
use Ork\Crom\Progress\ProgressInterface;
use Psr\Log\LoggerInterface;

/**
 * Scanner interface.
 */
interface ScannerInterface
{

    /**
     * Constructor.
     *
     * @param array<string, mixed> $config The configuration for this scanner.
     * @param ProgressInterface $progress The progress tracker.
     * @param LoggerInterface $logger A PSR-3 logger.
     * @param AbstractSchemaManager $schemaManager The Doctrine schema manager.
     */
    public function __construct(
        array $config,
        ProgressInterface $progress,
        LoggerInterface $logger,
        AbstractSchemaManager $schemaManager
    );

    /**
     * Invocation wrapper.
     */
    public function __invoke(): void;

    /**
     * Get a label for this scanner.
     *
     * @return string A label for this scanner.
     */
    public function getLabel(): string;

    /**
     * Get the logger.
     *
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface;

    /**
     * Get a short name for this scanner.
     *
     * @return string A short name for this scanner.
     */
    public function getName(): string;

    /**
     * Get the progress tracker.
     *
     * @return ProgressInterface The progress tracker.
     */
    public function getProgress(): ProgressInterface;

    /**
     * Get the schema manager.
     *
     * @return AbstractSchemaManager The schema manager.
     */
    public function getSchemaManager(): AbstractSchemaManager;

}
