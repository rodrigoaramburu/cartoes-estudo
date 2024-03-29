<?php

declare(strict_types=1);

use Domain\Util\EditorParser\EditorParser;

test('deve parsear um block', function () {
    $parser = new EditorParser();

    $json = '{"time":1662054793510,"blocks":[{"id":"VcsFwY4F9r","type":"paragraph","data":{"text":"testes"},"tunes":{"alignTune":{"alignment":"left"}}}],"version":"2.25.0"}';

    $html = $parser->parse($json);

    expect($html)->toBe('<p style="text-align: left">testes</p>');
});

test('deve parsear dois block', function () {
    $parser = new EditorParser();

    $json = <<<'JSON'
            { "time":1662054793510,
            "blocks":[
                {"id":"VcsFwY4F9r","type":"paragraph","data":{"text":"testes"},"tunes":{"alignTune":{"alignment":"left"}}},
                {"id":"VcsFwY4F92","type":"paragraph","data":{"text":"outro"},"tunes":{"alignTune":{"alignment":"right"}}}
            ],
            "version":"2.25.0"}
        JSON;
    $html = $parser->parse($json);

    expect($html)->toBe('<p style="text-align: left">testes</p><p style="text-align: right">outro</p>');
});

test('deve parsear block de EmbedImage', function () {
    $parser = new EditorParser();

    $json = <<<'JSON'
        {
            "time":1662057754901,
            "blocks":[
                {"id":"IUe3j2PbZB","type":"embedImage","data":{"url":"data:image/jpeg;base64,/9j/2w","align":"left","width": "auto","height": "auto"}}
            ],
            "version":"2.25.0"}
        JSON;
    $html = $parser->parse($json);

    expect($html)->toBe('<div><figure style="display: flex; justify-content: left"><img src="data:image/jpeg;base64,/9j/2w" style="width: auto; height: auto"></figure></div>');
});

test('deve parsear block de EmbedAudio', function () {
    $parser = new EditorParser();

    $json = <<<'JSON'
        {
            "time":1662057754901,
            "blocks":[
                {"id":"IUe3j2PbZB","type":"embedAudio","data":{"src":"data:audio/mp3;base64,/9j/2w"}}
            ],
            "version":"2.25.0"}
        JSON;
    $html = $parser->parse($json);

    expect($html)->toBe('<div style="display: flex; justify-content: center"><audio controls src="data:audio/mp3;base64,/9j/2w"></div>');
});


test('deve parsear block de Header', function () {
    $parser = new EditorParser();

    $json = <<<'JSON'
        {
            "time":1662057754901,
            "blocks":[
                {"id":"IUe3j2PbZB","type":"header","data":{"text":"teste", "level":"3"}, "tunes":{"alignTune":{"alignment":"center"}}}
            ],
            "version":"2.25.0"}
        JSON;
    $html = $parser->parse($json);

    expect($html)->toBe('<h3 style="text-align: center">teste</h3>');
});

test('deve parsear block de Code', function () {
    $parser = new EditorParser();

    $json = <<<'JSON'
        {
            "time":1662057754901,
            "blocks":[
                {"id":"IUe3j2PbZB","type":"code","data":{"code":"ls"}}
            ],
            "version":"2.25.0"}
        JSON;
    $html = $parser->parse($json);

    expect($html)->toBe('<code>ls</code>');
});
