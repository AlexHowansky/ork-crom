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

interface ProgressInterface
{

    /**
     * Get the exit value.
     *
     * @return int The exit value.
     */
    public function exit(): int;

    /**
     * Register an assertion failure.
     *
     * @param ScannerInterface $scanner The scanner that ran the assertion.
     * @param AssetInterface $asset The asset was scanned.
     * @param AssertionInterface $assertion The assertion that failed.
     *
     * @return void
     */
    public function fail(ScannerInterface $scanner, AssetInterface $asset, AssertionInterface $assertion): void;

    /**
     * Register an assertion pass.
     *
     * @param ScannerInterface $scanner The scanner that ran the assertion.
     * @param AssetInterface $asset The asset was scanned.
     * @param AssertionInterface $assertion The assertion that failed.
     *
     * @return void
     */
    public function pass(ScannerInterface $scanner, AssetInterface $asset, AssertionInterface $assertion): void;

    /**
     * Generate a summary of assets scanned.
     *
     * @return void
     */
    public function summary(): void;

}
