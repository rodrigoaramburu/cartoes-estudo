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
