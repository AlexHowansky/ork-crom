<?php

namespace Ork\Crom\Tests\Unit\Asset;

use Ork\Crom\Asset\AbstractAsset;
use PHPUnit\Framework\TestCase;

class AssetTest extends TestCase
{

    public function testDefaultLabelMatchesName(): void
    {
        $label = md5(random_bytes(32));
        $mockAsset = $this
            ->getMockBuilder(AbstractAsset::class)
            ->onlyMethods(['getName'])
            ->getMock();
        $this->assertSame('', $mockAsset->getLabel());
        $mockAsset->method('getName')->willReturn($label);
        $this->assertSame($label, $mockAsset->getLabel());
    }

    public function testTypeReflection(): void
    {
        $label = 'x' . md5(random_bytes(32));
        $mockAsset = $this
            ->getMockBuilder(AbstractAsset::class)
            ->setMockClassName($label . 'Asset')
            ->onlyMethods(['getName'])
            ->getMock();
        $this->assertSame($label, $mockAsset->getType());
    }

}
