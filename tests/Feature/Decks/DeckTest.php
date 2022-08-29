<?php

use Domain\Deck\Models\Card;
use Domain\Deck\Models\Deck;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

uses(RefreshDatabase::class);

test('deve listar os decks', function () {
    $decks = Deck::factory()->times(2)->create();

    $this->get(route('decks.index'))
        ->assertStatus(200)
        ->assertSee($decks[0]->name)
        ->assertSee($decks[1]->name);
});

test('deve exibir tela de criação de deck', function () {
    $this->get(route('decks.create'))
        ->assertStatus(200)
        ->assertSee('name="name"', escape: false);
});

test('deve salvar um deck', function () {
    $this->post(route('decks.store'), [
        'name' => 'Baralho Teste',
    ])
        ->assertRedirect(route('decks.index'))
        ->assertSessionHas('message-success', 'O Baralho foi salvo.');

    $this->assertDatabaseHas('decks', [
        'name' => 'Baralho Teste',
    ]);
});

test('não deve salvar deck com nome vazio', function () {
    $this->post(route('decks.store'), [
        'name' => '',
    ])
        ->assertStatus(302)
        ->assertSessionHasErrors(['name' => 'O nome deve ser preenchido']);

    $this->assertDatabaseMissing('decks', [
        'name' => '',
    ]);
});

test('não deve salvar deck se no existir', function () {
    $decks = Deck::factory()->create([
        'name' => 'Baralho Teste',
    ]);

    $this->post(route('decks.store'), [
        'name' => 'Baralho Teste',
    ])
    ->assertStatus(302)
    ->assertSessionHasErrors(['name' => 'O nome já existe']);

    $this->assertDatabaseMissing('decks', [
        'name' => '',
    ]);
});

test('deve deletar um deck', function () {
    $deck = Deck::factory()->create();

    $this->delete(route('decks.delete', $deck->id))
        ->assertRedirect(route('decks.index'))
        ->assertSessionHas('message-success', 'O Baralho foi deletado');

    $this->assertDatabaseMissing('decks', [
        'id' => $deck->id,
        'name' => $deck->name,
    ]);
});

test('deve retornar 404 se deck não existe ao deletar', function () {
    $this->delete(route('decks.delete', 521))
        ->assertStatus(404);
});

test('deve exibir tela de edição de deck', function () {
    $deck = Deck::factory()->create();

    $this->get(route('decks.edit', $deck->id))
        ->assertStatus(200)
        ->assertSee('name="name"', escape: false)
        ->assertSee('value="'.$deck->name.'"', escape: false)
        ->assertSee('name="id"', escape: false)
        ->assertSee('value="'.$deck->id.'"', escape: false);
});

test('deve retornar 404 se deck não existe', function () {
    $this->get(route('decks.edit', 521))
        ->assertStatus(404);
});

test('deve alterar um deck', function () {
    $deck = Deck::factory()->create();

    $this->put(route('decks.update', $deck->id), [
        'id' => $deck->id,
        'name' => 'Baralho Alterado',
    ])
        ->assertRedirect(route('decks.index'))
        ->assertSessionHas('message-success', 'O Baralho foi alterado');

    $this->assertDatabaseHas('decks', [
        'id' => $deck->id,
        'name' => 'Baralho Alterado',
    ]);
});

test('não deve alterar um deck com nome em branco', function () {
    $deck = Deck::factory()->create();

    $this->put(route('decks.update', $deck->id), [
        'id' => $deck->id,
        'name' => '',
    ])
        ->assertStatus(302)
        ->assertSessionHasErrors(['name' => 'O nome deve ser preenchido']);

    $this->assertDatabaseHas('decks', [
        'id' => $deck->id,
        'name' => $deck->name,
    ]);
});

test('deve alterar um deck com nome já existe mas é o proprio', function () {
    $deck = Deck::factory()->create();

    $this->put(route('decks.update', $deck->id), [
        'id' => $deck->id,
        'name' => $deck->name,
    ])
        ->assertRedirect(route('decks.index'))
        ->assertSessionHas('message-success', 'O Baralho foi alterado');

    $this->assertDatabaseHas('decks', [
        'id' => $deck->id,
        'name' => $deck->name,
    ]);
});

test('deve exportar baralho', function () {
    $deck = Deck::factory()->create();
    $cards = Card::factory()->times(3)->create([
        'deck_id' => $deck->id,
    ]);

    $response = $this->get(route('decks.export', $deck->id))
        ->assertStatus(200);

    $tmpfname = tempnam('/tmp', 'tmpzip');
    file_put_contents($tmpfname, $response->content());

    $zip = new ZipArchive();
    $zip->open($tmpfname);
    $deckJson = json_decode($zip->getFromName('deck.json'), true);
    unlink($tmpfname);

    expect($deckJson['deck'])->toBe($deck->name);
    expect($deckJson['cards'][0]['front'])->toBe($cards[0]->front);
    expect($deckJson['cards'][0]['back'])->toBe($cards[0]->back);
    expect($deckJson['cards'][1]['front'])->toBe($cards[1]->front);
    expect($deckJson['cards'][1]['back'])->toBe($cards[1]->back);
});

test('deve importar um baralho', function () {
    $data = json_encode([
        'deck' => 'Deck Teste',
        'hardIntervalFactor' => 1.5,
        'normalIntervalFactor' => 2,
        'easyIntervalFactor' => 2.5,
        'cards' => [
            ['front' => 'front1', 'back' => 'back1'],
            ['front' => 'front2', 'back' => 'back2'],
        ],
    ]);

    $tmpfname = tempnam('/tmp', 'tmpzip');
    $zip = new ZipArchive();
    $zip->open($tmpfname, ZipArchive::CREATE);
    $zip->addFromString('deck.json', $data);
    $zip->close();

    $this->post(route('decks.import'), [
        'deck-file' => new UploadedFile($tmpfname, 'deck-1.zdeck'),
    ])
        ->assertRedirect(route('decks.index'))
        ->assertSessionHas('message-success', 'O Baralho foi importado com sucesso.');

    unlink($tmpfname);

    $this->assertDatabaseHas('decks', [
        'name' => 'Deck Teste',
    ]);

    $this->assertDatabaseHas('cards', [
        'front' => 'front1', 'back' => 'back1', 'deck_id' => 1,
    ]);
});

test('deve exibir mensagem se formato de baralho inválido ao importa', function () {
    $tmpfname = tempnam('/tmp', 'tmptext');
    file_put_contents($tmpfname, 'um teste qualquer');

    $this->post(route('decks.import'), [
        'deck-file' => new UploadedFile($tmpfname, 'deck-1.zdeck'),
    ])
    ->assertRedirect(route('decks.index'))
    ->assertSessionHas('message-error', 'Error ao Importar Baralho: Formato de Arquivo Inválido');

    unlink($tmpfname);
});
