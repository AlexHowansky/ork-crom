<?php

namespace Ork\Crom\Tests\Unit;

use Ork\Crom\Asset\AbstractAsset;
use Ork\Crom\Assertion\AbstractAssertion;
use Ork\Crom\Progress\DotsProgress;
use Ork\Crom\Progress\FailProgress;
use Ork\Crom\Progress\ProgressInterface;
use Ork\Crom\Progress\SilentProgress;
use Ork\Crom\Progress\SummaryProgress;
use Ork\Crom\Progress\VerboseProgress;
use Ork\Crom\Scanner\AbstractScanner;

class ProgressTest extends AbstractUnitTestCase
{

    public function providerForProgress(): array
    {
        return [
            [new DotsProgress(), '/\./'],
            [new FailProgress(), '/Pass Fail Scanner/'],
            [new SilentProgress(), '/^$/'],
            [new SummaryProgress(), '/Pass Fail Scanner/'],
            [new VerboseProgress(), '/no label/'],
        ];
    }

    /**
     * @dataProvider providerForProgress
     */
    public function testProgress(ProgressInterface $progress, string $outputRegex): void
    {
        $this->expectOutputRegex($outputRegex);
        $assertion = $this->getMockForAbstractClass(AbstractAssertion::class, [[]], 'mockAssertion');
        $asset = $this->getMockForAbstractClass(AbstractAsset::class, [], 'mockAsset', false);
        $scanner = $this->getMockForAbstractClass(AbstractScanner::class, [], 'mockScanner', false);
        $this->assertSame(0, $progress->exit());
        $progress->pass($scanner, $asset, $assertion);
        $this->assertSame(0, $progress->exit());
        $progress->fail($scanner, $asset, $assertion);
        $this->assertSame(1, $progress->exit());
        $progress->summary();
    }

}
