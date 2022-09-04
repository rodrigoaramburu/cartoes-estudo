<?php

declare(strict_types=1);

namespace Domain\Util\EditorParser;

class HeaderBlock implements BlockInterface
{
    public function parse(array $block): string
    {
        $align = $block['tunes']['alignTune']['alignment'];
        $level = $block['data']['level'];
        return  "<h$level style=\"text-align: $align\">{$block['data']['text']}</h$level>";
    }
}
