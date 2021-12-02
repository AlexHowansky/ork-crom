<?php

namespace Ork\Crom\Tests\Unit\Asset;

use Ork\Crom\Asset\NamespaceAsset;
use PHPUnit\Framework\TestCase;

class NamespaceAssetTest extends TestCase
{

    public function testAsset(): void
    {
        $name = md5(random_bytes(32));
        $asset = new NamespaceAsset($name);
        $this->assertSame($name, $asset->getLabel());
        $this->assertSame($name, $asset->getName());
        $this->assertSame('namespace', $asset->getType());
    }

}
