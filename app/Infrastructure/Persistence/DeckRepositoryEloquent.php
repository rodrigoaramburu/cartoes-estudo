<?php

declare(strict_types=1);

namespace Infrastructure\Persistence;

use Domain\Deck\DTO\DeckDTO;
use Domain\Deck\Exceptions\DeckNotFoundException;
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
            'name' => $deck->name(),
        ]);
    }

    public function delete(int $id): void
    {
        Deck::destroy($id);
    }

    public function findById(int $id): DeckDTO
    {
        $deckModel = Deck::find($id);
        if (! $deckModel) {
            throw new DeckNotFoundException('Baralho não encontrado');
        }

        return DeckDTO::fromArray(
            data: Deck::find($id)->toArray()
        );
    }

    public function update(DeckDTO $deck): void
    {
        $deckModel = Deck::find($deck->id());
        if (! $deckModel) {
            throw new DeckNotFoundException('Baralho não encontrado');
        }

        $deckModel->update([
            'name' => $deck->name(),
        ]);
    }
}
