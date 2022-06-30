<?php

declare(strict_types=1);

namespace Infrastructure\Persistence;

use Domain\Deck\DTO\DeckDTO;
use Domain\Deck\Models\Deck;
use Domain\Deck\Repositories\DeckRepositoryInterface;
use Illuminate\Support\Collection;

final class DeckRepositoryEloquent implements DeckRepositoryInterface
{
    public function all(): Collection
    {
        $decks = Deck::all();
        $decks->transform(function ($deckModel) {
            return DeckDTO::fromArray($deckModel->toArray());
        });

        return $decks;
    }

    public function save(DeckDTO $deck): void
    {
        Deck::create([
            'name' => $deck->name()
        ]);
    }
}
