<?php

declare(strict_types=1);

namespace Domain\Util\EditorParser;

class EmbedImageBlock implements BlockInterface
{
    public function parse(array $block): string
    {
        $align = $block['data']['align'];
        $url = $block['data']['url'];
        $width = $block['data']['width'];
        $height = $block['data']['height'];

        return  "<div><figure style=\"display: flex; justify-content: $align\"><img src=\"$url\" style=\"width: $width; height: $height\"></figure></div>";
    }
}
