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
        $mockAssertion = $this->getMockForAbstractClass(AbstractAssertion::class, [[]]);
        $mockAsset = $this->getMockForAbstractClass(AbstractAsset::class);
        $this->expectException(LogicException::class);
        $this->expectExceptionMessageMatches('/ does not have an assert\(\) method./');
        $mockAssertion($mockAsset);
    }

}
