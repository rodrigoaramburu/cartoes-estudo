<?php declare(strict_types=1);
namespace Domain\Util\EditorParser;

interface BlockInterface 
{
    public function parse(array $block): string;
}