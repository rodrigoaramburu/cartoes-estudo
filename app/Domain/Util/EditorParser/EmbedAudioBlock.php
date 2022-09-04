<?php

declare(strict_types=1);

namespace Domain\Util\EditorParser;

class EmbedAudioBlock implements BlockInterface
{
    public function parse(array $block): string
    {
        $src = $block['data']['src'];

        return  "<div style=\"display: flex; justify-content: center\"><audio controls src=\"$src\"></div>";
    }
}
