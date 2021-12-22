<?php

/**
 * Ork CROM
 *
 * @package   Ork\Crom
 * @copyright 2021 Alex Howansky (https://github.com/AlexHowansky)
 * @license   https://github.com/AlexHowansky/ork-crom/blob/master/LICENSE MIT License
 * @link      https://github.com/AlexHowansky/ork-crom
 */

namespace Ork\Crom\Progress;

use Ork\Crom\Asset\AssetInterface;
use Ork\Crom\Assertion\AssertionInterface;
use Ork\Crom\Scanner\ScannerInterface;

/**
 * A progress meter that displays a summarization.
 */
class SummaryProgress extends SilentProgress
{

    use AnsiTrait;

    /**
     * Gather assertion statistics.
     *
     * @var array<string, mixed>
     */
    protected array $stats = [];

    /**
     * Register an assertion failure.
     *
     * @param ScannerInterface $scanner The scanner that ran the assertion.
     * @param AssetInterface $asset The asset was scanned.
     * @param AssertionInterface $assertion The assertion that failed.
     *
     * @return void
     */
    public function fail(ScannerInterface $scanner, AssetInterface $asset, AssertionInterface $assertion): void
    {
        parent::fail($scanner, $asset, $assertion);
        $this->increment('scanner', $scanner->getLabel(), 'fail');
        $this->increment('assertion', $assertion->getLabel(), 'fail');
    }

    /**
     * Increment a counter.
     *
     * @param string $stat The stat to increment.
     * @param string $label The group label.
     * @param string $type The type of action to increment.
     *
     * @return void
     */
    protected function increment(string $stat, string $label, string $type): void
    {
        $this->stats[$stat][$label][$type] = ($this->stats[$stat][$label][$type] ?? 0) + 1;
    }

    /**
     * Register an assertion pass.
     *
     * @param ScannerInterface $scanner The scanner that ran the assertion.
     * @param AssetInterface $asset The asset was scanned.
     * @param AssertionInterface $assertion The assertion that failed.
     *
     * @return void
     */
    public function pass(ScannerInterface $scanner, AssetInterface $asset, AssertionInterface $assertion): void
    {
        $this->increment('scanner', $scanner->getLabel(), 'pass');
        $this->increment('assertion', $assertion->getLabel(), 'pass');
    }

    /**
     * Generate a summary of assets scanned.
     *
     * @return void
     */
    public function summary(): void
    {
        foreach ($this->stats as $stat => $stats) {
            $this->write('<header>');
            $this->write(sprintf("\nPass Fail %s\n", ucfirst($stat)));
            $this->write(sprintf("---- ---- %s\n", str_repeat('-', strlen($stat))));
            $this->write('</>');
            foreach ($stats as $label => $type) {
                $this->write(
                    sprintf(
                        "<%s>%4d</> <%s>%4d</> <%s>%s</>\n",
                        ($type['pass'] ?? 0) > 0 ? 'pass' : 'fail',
                        $type['pass'] ?? 0,
                        ($type['fail'] ?? 0) > 0 ? 'fail' : 'pass',
                        $type['fail'] ?? 0,
                        $stat,
                        $stat === 'assertion' ? $this->getAnsiLabel($label, $stat) : $label
                    )
                );
            }
        }
        $this->write("\n");
    }

}
