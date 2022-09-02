<?php declare(strict_types=1);
namespace Domain\Util\EditorParser;


class ParagraphBlock implements BlockInterface
{
    public function parse(array $block): string
    {
        $align = $block['tunes']['alignTune']['alignment'];
        return  "<p style=\"text-align: $align\">{$block['data']['text']}</p>";
    }
}