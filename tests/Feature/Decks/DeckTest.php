<?php

use Domain\Deck\Models\Deck;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
        ->assertSessionHasErrors(['name'=>'O nome deve ser preenchido']);

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
    ->assertSessionHasErrors(['name'=>'O nome já existe']);

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
        'name' =>$deck->name,
    ]);
});
