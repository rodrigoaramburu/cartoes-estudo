<?php

declare(strict_types=1);

namespace Domain\Util\EditorParser;

class CodeBlock implements BlockInterface
{
    public function parse(array $block): string
    {
        return  "<code>{$block['data']['code']}</code>";
    }
}
