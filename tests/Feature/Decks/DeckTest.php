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
        ->assertSessionHasErrors(['name'=>'O nome deve ser preenchido']);

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
