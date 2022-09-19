<?php

declare(strict_types=1);

namespace Domain\Util\EditorParser;

class CodeBlock implements BlockInterface
{
    public function parse(array $block): string
    {
        $code = htmlentities($block['data']['code']);
        //$code = nl2br($code);
        return  "<code style=\"white-space: pre;width:100%; padding:10px\">{$code}</code>";
    }
}
