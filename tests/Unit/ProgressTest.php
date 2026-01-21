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
use PHPUnit\Framework\Attributes\DataProvider;

class ProgressTest extends AbstractUnitTestCase
{

    public static function providerForProgress(): array
    {
        return [
            [new DotsProgress(), '/\./'],
            [new FailProgress(), '/Pass Fail Scanner/'],
            [new SilentProgress(), '/^$/'],
            [new SummaryProgress(), '/Pass Fail Scanner/'],
            [new VerboseProgress(), '/no label/'],
        ];
    }

    #[DataProvider('providerForProgress')]
    public function testProgress(ProgressInterface $progress, string $outputRegex): void
    {
        $this->expectOutputRegex($outputRegex);
        $assertion = $this->createStub(AbstractAssertion::class);
        $asset = $this->createStub(AbstractAsset::class);
        $scanner = $this->createStub(AbstractScanner::class);
        $this->assertSame(0, $progress->exit());
        $progress->pass($scanner, $asset, $assertion);
        $this->assertSame(0, $progress->exit());
        $progress->fail($scanner, $asset, $assertion);
        $this->assertSame(1, $progress->exit());
        $progress->summary();
    }

}
