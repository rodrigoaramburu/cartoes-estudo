<?php

declare(strict_types=1);

use Domain\Deck\Models\Card;
use Domain\Deck\Models\Deck;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('deve listar os cards de um deck', function () {
    $deck1 = Deck::factory()->create();
    $deck2 = Deck::factory()->create();

    $cards1 = Card::factory()->times(3)->create([
        'deck_id' => $deck1->id,
    ]);

    $cards2 = Card::factory()->times(3)->create([
        'deck_id' => $deck2->id,
    ]);

    $this->get(route('cards.index', $deck1->id))
        ->assertStatus(200)
        ->assertSee($cards1[0]->front)
        ->assertSee($cards1[1]->back)
        ->assertDontSee($cards2[0]->back)
        ->assertDontSee($cards2[1]->back);
});

test('deve exibir tela de adicionar cartão', function () {
    $decks = Deck::factory()->times(3)->create();

    $this->get(route('cards.create'))
        ->assertStatus(200)
        ->assertSee('name="front"', escape: false)
        ->assertSee('name="back"', escape: false)
        ->assertSee('name="deck_id"', escape: false)
        ->assertSee("value=\"{$decks[0]->id}\">{$decks[0]->name}</option>", escape: false)
        ->assertSee("value=\"{$decks[1]->id}\">{$decks[1]->name}</option>", escape: false);
});

test('deve salvar um card', function () {
    $decks = Deck::factory()->times(3)->create();

    $this->post(route('cards.store'), [
        'front' => 'o texto da frente',
        'back' => 'o texto do verso',
        'deck_id' => $decks[0]->id,
    ])
        ->assertRedirect(route('cards.index', $decks[0]->id))
        ->assertSessionHas('message-success', 'O cartão foi adicionado');

    $this->assertDatabaseHas('cards', [
        'front' => 'o texto da frente',
        'back' => 'o texto do verso',
        'deck_id' => $decks[0]->id,
    ]);
});

test('não deve salvar card se não tiver frente, verso e deck', function () {
    $this->post(route('cards.store'), [
        'front' => '',
        'back' => '',
        'deck_id' => '',
    ])
    ->assertStatus(302)
    ->assertSessionHasErrors(['front'=>'A frente do cartão deve ser preenchida'])
    ->assertSessionHasErrors(['back'=>'O verso do cartão deve ser preenchido'])
    ->assertSessionHasErrors(['deck_id'=>'O Baralho do cartão deve ser selecionado']);

    $this->assertDatabaseMissing('decks', [
        'front' => '',
        'back' => '',
    ]);
});

test('deve deletar um card', function () {
    $deck = Deck::factory()->create();
    $card = Card::factory()->create([
        'deck_id' => $deck->id,
    ]);

    $this->delete(route('cards.delete', $card->id))
        ->assertRedirect(route('cards.index', $deck->id))
        ->assertSessionHas('message-success', 'O Cartão de Estudo foi deletado.');

    $this->assertDatabaseMissing('cards', [
        'id' => $card->id,
    ]);
});

test('deve exibit tela de edição de cartão de estudo', function () {
    $decks = Deck::factory()->times(2)->create();
    $card = Card::factory()->create([
        'deck_id' => $decks[0]->id,
    ]);

    $this->get(route('cards.edit', $card->id))
        ->assertStatus(200)

        ->assertSee('name="id"', escape: false)
        ->assertSee('name="front"', escape: false)
        ->assertSee('name="back"', escape: false)
        ->assertSee('name="deck_id"', escape: false)
        ->assertSee("selected value=\"{$decks[0]->id}\">{$decks[0]->name}</option>", escape: false)
        ->assertSee("value=\"{$decks[1]->id}\">{$decks[1]->name}</option>", escape: false)

        ->assertSee("value=\"{$card->id}\"", escape: false)
        ->assertSee("{$card->front}</textarea>", escape: false)
        ->assertSee("{$card->back}</textarea>", escape: false);
});

test('deve alterar um cartão de estudo', function () {
    $decks = Deck::factory()->times(2)->create();
    $card = Card::factory()->create([
        'deck_id' => $decks[0]->id,
    ]);

    $this->put(route('cards.update', $card->id), [
        'id' => $card->id,
        'front' => 'Front alterado',
        'back' => 'Back alterado',
        'deck_id' => $decks[1]->id,
    ])
        ->assertRedirect(route('cards.index', $decks[1]->id))
        ->assertSessionHas('message-success', 'O Cartão de Estudos foi alterado');

    $this->assertDatabaseHas('cards', [
        'front' => 'Front alterado',
        'back' => 'Back alterado',
        'deck_id' => $decks[1]->id,
    ]);
});


test('não deve alterar cartão de estudo se não tiver frente, verso e deck', function () {

    $decks = Deck::factory()->times(2)->create();
    $card = Card::factory()->create([
        'deck_id' => $decks[0]->id,
    ]);


    $this->put(route('cards.update', $card->id), [
        'id' => $card->id,
        'front' => '',
        'back' => '',
        'deck_id' => '',
    ])
    ->assertStatus(302)
    ->assertSessionHasErrors(['front'=>'A frente do cartão deve ser preenchida'])
    ->assertSessionHasErrors(['back'=>'O verso do cartão deve ser preenchido'])
    ->assertSessionHasErrors(['deck_id'=>'O Baralho do cartão deve ser selecionado']);

    $this->assertDatabaseMissing('decks', [
        'id' => $card->id,
        'front' => '',
        'back' => '',
    ]);
});