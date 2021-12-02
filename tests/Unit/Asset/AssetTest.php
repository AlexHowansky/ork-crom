<?php

namespace Ork\Crom\Tests\Unit\Asset;

use Ork\Crom\Asset\AbstractAsset;
use PHPUnit\Framework\TestCase;

class AssetTest extends TestCase
{

    public function testDefaultLabelMatchesName(): void
    {
        $label = md5(random_bytes(32));
        $mockAsset = $this->getMockForAbstractClass(AbstractAsset::class);
        $this->assertSame('', $mockAsset->getLabel());
        $mockAsset->method('getName')->willReturn($label);
        $this->assertSame($label, $mockAsset->getLabel());
    }

    public function testTypeReflection(): void
    {
        $mockAsset = $this->getMockForAbstractClass(AbstractAsset::class, [], 'FooBarAsset');
        $this->assertSame('foobar', $mockAsset->getType());
    }

}
