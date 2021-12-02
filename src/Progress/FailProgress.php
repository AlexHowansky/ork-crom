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

use IntlChar;
use Ork\Crom\Asset\AssetInterface;
use Ork\Crom\Assertion\AssertionInterface;
use Ork\Crom\Scanner\ScannerInterface;

/**
 * A progress meter that is verbose, but only for assertion failures.
 */
class FailProgress extends SummaryProgress
{

    use AnsiTrait;

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
        $this->verbose($scanner, $asset, $assertion, false);
    }

    /**
     * Output a line describing the scanner, asset, and assertion that just fired.
     *
     * @param ScannerInterface $scanner The scanner that ran the assertion.
     * @param AssetInterface $asset The asset was scanned.
     * @param AssertionInterface $assertion The assertion that failed.
     *
     * @return void
     */
    protected function verbose(
        ScannerInterface $scanner,
        AssetInterface $asset,
        AssertionInterface $assertion,
        bool $pass
    ): void {
        $this->write(
            sprintf(
                "<%s>%s</> <option>%s</> <scanner>%s</> <asset>%s</> %s\n",
                ($pass === true) ? 'pass' : 'fail',
                IntlChar::chr($pass === true ? 0x2714 : 0x2718),
                $scanner->getName(),
                ($scanner->getLabel() === $scanner->getName()) ? '(no label)' : $scanner->getLabel(),
                $asset->getLabel(),
                $this->getAnsiLabel($assertion->getLabel())
            )
        );
    }

}
