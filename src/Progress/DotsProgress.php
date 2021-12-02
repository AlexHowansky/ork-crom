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
 * A progress meter that displays a dot per assertion.
 */
class DotsProgress extends SilentProgress
{

    use AnsiTrait;

    // How wide should our dots go?
    protected const WIDTH = 40;

    /**
     * The number of dots.
     *
     * @var int
     */
    protected int $count = 0;

    /**
     * Draw a dot.
     *
     * @return void
     */
    protected function dot(bool $pass): void
    {
        $this->write($pass === true ? '<pass>.</>' : '<fail>E</>');
        if (++$this->count % self::WIDTH === 0) {
            $this->write(sprintf(" <option>[%d]</>\n", $this->count));
        }
    }

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
        $this->dot(false);
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
        parent::pass($scanner, $asset, $assertion);
        $this->dot(true);
    }

    /**
     * Generate a summary of assets scanned.
     *
     * @return void
     */
    public function summary(): void
    {
        /**
         * PHPStan doesn't seem to recognize printf's variable width parameters.
         *
         * @phpstan-ignore-next-line
         */
        $this->write(sprintf("%*s <option>[%d]</>\n", self::WIDTH - $this->count % self::WIDTH, ' ', $this->count));
    }

}
