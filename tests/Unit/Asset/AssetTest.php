<?php

namespace Ork\Crom\Tests\Unit\Asset;

use Ork\Crom\Asset\AbstractAsset;
use PHPUnit\Framework\TestCase;

class AssetTest extends TestCase
{

    public function testDefaultLabelMatchesName(): void
    {
        $label = md5(random_bytes(32));
        $stubAsset = $this
            ->getStubBuilder(AbstractAsset::class)
            ->onlyMethods(['getName'])
            ->getStub();
        $this->assertSame('', $stubAsset->getLabel());
        $stubAsset->method('getName')->willReturn($label);
        $this->assertSame($label, $stubAsset->getLabel());
    }

    public function testTypeReflection(): void
    {
        $label = 'x' . md5(random_bytes(32));
        $stubAsset = $this
            ->getStubBuilder(AbstractAsset::class)
            ->setStubClassName($label . 'Asset')
            ->onlyMethods(['getName'])
            ->getStub();
        $this->assertSame($label, $stubAsset->getType());
    }

}
