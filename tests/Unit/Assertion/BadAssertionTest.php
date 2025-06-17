<?php

namespace Ork\Crom\Tests\Unit\Assertion;

use LogicException;
use Ork\Crom\Assertion\AbstractAssertion;
use Ork\Crom\Asset\AbstractAsset;
use PHPUnit\Framework\TestCase;

class BadAssertionTest extends TestCase
{

    public function testMissingAssertMethod(): void
    {
        $mockAssertion = $this
            ->getMockBuilder(AbstractAssertion::class)
            ->onlyMethods(['getName'])
            ->disableOriginalConstructor()
            ->getMock();
        $mockAsset = $this
            ->getMockBuilder(AbstractAsset::class)
            ->onlyMethods(['getName'])
            ->getMock();
        $this->expectException(LogicException::class);
        $this->expectExceptionMessageMatches('/ does not have an assert\(\) method./');
        $mockAssertion($mockAsset);
    }

}
