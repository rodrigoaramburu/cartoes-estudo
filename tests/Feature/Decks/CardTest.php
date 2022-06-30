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
