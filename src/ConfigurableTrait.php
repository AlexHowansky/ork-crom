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

use RuntimeException;
use Symfony\Component\Yaml\Yaml;

trait ConfigurableTrait
{

    /**
     * The configuration for this scan.
     *
     * @var array<string, mixed>
     */
    protected array $config = [];

    /**
     * Constructor.
     *
     * @param string $configFile The name of the configuration file.
     */
    public function __construct(string $configFile = null)
    {
        if ($configFile !== null) {
            $this->setConfig($configFile);
        }
    }

    /**
     * Get a configuration parameter.
     *
     * @param string $parameter The name of the parameter to get.
     * @param mixed $default The value to return if the parameter has not been defined.
     *
     * @return mixed The requested configuration parameter.
     */
    public function getConfig(string $parameter, mixed $default = []): mixed
    {
        return $this->config[$parameter] ?? $default;
    }

    /**
     * Merge a configuration for this scan.
     *
     * @param string $configFile The name of the configuration file to merge.
     *
     * @return self Allow method chaining.
     * @throws RuntimeException On configuration file error.
     */
    public function mergeConfig(string $configFile): self
    {
        if (is_readable($configFile) === false) {
            throw new RuntimeException('Unable to read configuration file');
        }
        $config = match (strtolower(pathinfo($configFile, PATHINFO_EXTENSION))) {
            'yaml' => Yaml::parseFile($configFile),
            'json' => json_decode((string) file_get_contents($configFile), true, 512, JSON_THROW_ON_ERROR),
            default => throw new RuntimeException('Unknown configuration file type'),
        };
        $this->config = array_merge($this->config, $config);
        return $this;
    }

    /**
     * Set the configuration for this scan.
     *
     * @param string $configFile The name of the configuration file.
     *
     * @return self Allow method chaining.
     * @throws RuntimeException On configuration file error.
     */
    public function setConfig(string $configFile): self
    {
        $this->config = [];
        return $this->mergeConfig($configFile);
    }

}
