<?php

namespace Ork\Crom\Tests\Unit;

use Ork\Crom\Scan;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

abstract class AbstractUnitTestCase extends TestCase
{

    protected Scan $scan;

    protected function getConfig(): ?string
    {
        return $this->getConfigFile('yaml') ?? $this->getConfigFile('json') ?? null;
    }

    protected function getConfigFile(string $extension): ?string
    {
        $file = sprintf(
            '%s/config/%s.%s',
            dirname((new ReflectionClass($this))->getFileName()),
            $this->getName(false),
            $extension
        );
        return file_exists($file) === true ? $file : null;
    }

    public function setUp(): void
    {
        $this->scan = new Scan($this->getConfig());
    }

}
