<?php

/**
 * Ork CROM
 *
 * @package   Ork\Crom
 * @copyright 2021 Alex Howansky (https://github.com/AlexHowansky)
 * @license   https://github.com/AlexHowansky/ork-crom/blob/master/LICENSE MIT License
 * @link      https://github.com/AlexHowansky/ork-crom
 */

namespace Ork\Crom;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Monolog\Handler\HandlerInterface;
use Monolog\Logger;
use Ork\Crom\Progress\ProgressInterface;
use Ork\Crom\Scanner\ScannerInterface;
use ReflectionClass;
use RuntimeException;

/**
 * Scan manager.
 */
class Scan
{

    use ConfigurableTrait;

    /**
     * Use this name for the logger if we're not given one.
     */
    protected const DEFAULT_LOGGER_NAME = 'crom';

    /**
     * The Doctrine database connection that we'll use to scan the schema.
     *
     * @var Connection
     */
    protected Connection $connection;

    /**
     * A Monolog logger to use for logging.
     *
     * @var Logger
     */
    protected Logger $logger;

    /**
     * A progress meter.
     *
     * @var ProgressInterface
     */
    protected ProgressInterface $progress;

    /**
     * Main scanner loop.
     *
     * @return int The exit value to use.
     *
     * @throws RuntimeException If no scanner configuration is present.
     */
    public function __invoke(): int
    {
        $scanners = $this->getConfig('scanners');
        if (empty($scanners) === true) {
            throw new RuntimeException('Configuration has no scanners');
        }
        foreach ($scanners as $config) {
            $this->getScanner($config)();
        }
        $this->getProgress()->summary();
        return $this->getProgress()->exit();
    }

    /**
     * Get the database connection instance.
     *
     * @return Connection The database connection instance.
     */
    public function getConnection(): Connection
    {
        if (isset($this->connection) === false) {
            $this->connection = DriverManager::getConnection($this->getConfig('database'));
            $this->connection->connect();
        }
        return $this->connection;
    }

    /**
     * Get the logger instance.
     *
     * @return Logger The logger instance.
     * @throws RuntimeException On configuration file error.
     */
    protected function getLogger(): Logger
    {
        if (isset($this->logger) === false) {
            $this->logger = new Logger($this->getConfig('logger')['name'] ?? self::DEFAULT_LOGGER_NAME);
            foreach ($this->getConfig('logger')['handlers'] ?? [] as $handler) {
                if (array_key_exists('handler', $handler) === false) {
                    throw new RuntimeException('Configuration is missing log handler');
                }
                if (class_exists($handler['handler']) === false) {
                    throw new RuntimeException(
                        sprintf('Configuration references unknown log handler "%s"', $handler['handler'])
                    );
                }
                /**
                 * PHPStan can't figure out that the class we're about to create
                 * will implement HandlerInterface.
                 *
                 * @phpstan-ignore-next-line
                 */
                $this->logger->pushHandler(new ($handler['handler'])(...$handler['args'] ?? []));
            }
        }
        return $this->logger;
    }

    /**
     * Get the progress meter.
     *
     * @return ProgressInterface The progress meter.
     *
     * @throws RuntimeException If an unknown progress meter is selected.
     */
    protected function getProgress(): ProgressInterface
    {
        if (isset($this->progress) === false) {
            $className = sprintf(
                '%s\%sProgress',
                (new ReflectionClass(ProgressInterface::class))->getNamespaceName(),
                ucfirst(strtolower($this->getConfig('progress', 'silent')))
            );
            if (class_exists($className) === false) {
                throw new RuntimeException(
                    sprintf('Configuration references unknown progress "%s"', $this->getConfig('progress'))
                );
            }
            /**
             * PHPStan can't figure out that the class we're about to create
             * will implement ProgressInterface.
             *
             * @phpstan-ignore-next-line
             */
            $this->progress = new $className();
        }
        // @phpstan-ignore-next-line
        return $this->progress;
    }

    /**
     * Instantiate a scanner object.
     *
     * @param array<string, mixed> $config The scanner configuration.
     *
     * @throws RuntimeException On configuration file error.
     */
    protected function getScanner(array $config): ScannerInterface
    {
        if (array_key_exists('scanner', $config) === false) {
            throw new RuntimeException('Configuration is missing scanner name');
        }
        if (empty($config['assertions'] ?? []) === true) {
            throw new RuntimeException(
                sprintf('Configuration for scanner "%s" has no assertions', $config['scanner'])
            );
        }
        $class = strpos($config['scanner'], '\\') === 0
            ? $config['scanner']
            : sprintf(
                '%s\%sScanner',
                (new ReflectionClass(ScannerInterface::class))->getNamespaceName(),
                ucfirst(strtolower($config['scanner']))
            );
        if (class_exists($class) === false) {
            throw new RuntimeException(sprintf('Configuration references unknown scanner "%s"', $config['scanner']));
        }
        unset($config['scanner']);
        /**
         * PHPStan can't figure out that the class we're about to create will
         * implement ScannerInterface.
         *
         * @phpstan-ignore-next-line
         */
        return new $class(
            $config,
            $this->getProgress(),
            $this->getLogger(),
            $this->getConnection()->createSchemaManager()
        );
    }

    /**
     * Push a new log handler to the logger stack.
     *
     * @param HandlerInterface $handler The handler to push.
     *
     * @return self Allow method chaining.
     */
    public function pushHandler(HandlerInterface $handler): self
    {
        $this->getLogger()->pushHandler($handler);
        return $this;
    }

}
