<?php

declare(strict_types=1);

namespace Domain\Util\EditorParser;

class EditorParser
{
    public function __construct()
    {
        $this->blockProcessors['paragraph'] = new ParagraphBlock();
        $this->blockProcessors['embedImage'] = new EmbedImageBlock();
        $this->blockProcessors['embedAudio'] = new EmbedAudioBlock();
        $this->blockProcessors['header'] = new HeaderBlock();
    }

    public function parse(string $json): string
    {
        $data = json_decode($json, true);

        $html = '';
        foreach ($data['blocks'] ?? [] as $block) {
            $html .= $this->blockProcessors[$block['type']]->parse($block);
        }

        return $html;
    }
}
