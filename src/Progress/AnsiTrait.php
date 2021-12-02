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

use Bramus\Ansi\Ansi;
use Bramus\Ansi\Writers\BufferWriter;
use Bramus\Ansi\ControlSequences\EscapeSequences\Enums\SGR;

/**
 * Common methods for ANSI colorization.
 */
trait AnsiTrait
{

    /**
     * ANSI code tags.
     *
     * @var array<string, string>
     */
    protected array $ansi = [];

    /**
     * Constructor.
     */
    public function __construct()
    {
        $ansi = new Ansi(new BufferWriter());
        $this->ansi = [
            '<assertion>' => $ansi->color([SGR::COLOR_FG_CYAN_BRIGHT])->get(),
            '<asset>' => $ansi->color([SGR::COLOR_FG_PURPLE_BRIGHT])->get(),
            '<fail>' => $ansi->color([SGR::COLOR_FG_RED])->get(),
            '<header>' => $ansi->color([SGR::COLOR_FG_WHITE])->get(),
            '<option>' => $ansi->color([SGR::COLOR_FG_BLACK_BRIGHT])->get(),
            '<pass>' => $ansi->color([SGR::COLOR_FG_GREEN_BRIGHT])->get(),
            '<scanner>' => $ansi->color([SGR::COLOR_FG_BLUE_BRIGHT])->get(),
            '<warn>' => $ansi->color([SGR::COLOR_FG_YELLOW_BRIGHT])->get(),
            '</>' => $ansi->reset()->get(),
        ];
    }

    /**
     * Get an ANSI-ified label.
     *
     * @param string $label The label to ANSI-ify.
     *
     * @return string The ANSI-ified label.
     */
    protected function getAnsiLabel(string $label, string $wrapper = 'assertion'): string
    {
        return preg_replace(
            '/^(NOT\s+)?(\S+)(.*)$/',
            '<warn>$1</><' . $wrapper . '>$2</><option>$3</>',
            $label
        ) ?? $label;
    }

    /**
     * Output a string with ANSI coloring.
     *
     * @param string $message The message to output.
     *
     * @return void
     */
    protected function write(string $message): void
    {
        echo str_replace(array_keys($this->ansi), array_values($this->ansi), $message);
    }

}
