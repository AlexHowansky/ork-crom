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
        $stubAssertion = $this
            ->getStubBuilder(AbstractAssertion::class)
            ->onlyMethods(['getName'])
            ->disableOriginalConstructor()
            ->getStub();
        $stubAsset = $this
            ->getStubBuilder(AbstractAsset::class)
            ->onlyMethods(['getName'])
            ->getStub();
        $this->expectException(LogicException::class);
        $this->expectExceptionMessageMatches('/ does not have an assert\(\) method./');
        $stubAssertion($stubAsset);
    }

}
