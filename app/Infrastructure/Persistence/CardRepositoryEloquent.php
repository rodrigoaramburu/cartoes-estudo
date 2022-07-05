<?php

declare(strict_types=1);

namespace Infrastructure\Persistence;

use Domain\Deck\DTO\CardDTO;
use Domain\Deck\DTO\DeckDTO;
use Domain\Deck\Exceptions\CardNotFoundException;
use Domain\Deck\Models\Card;
use Domain\Deck\Repositories\CardRepositoryInterface;
use Illuminate\Support\Collection;

final class CardRepositoryEloquent implements CardRepositoryInterface
{
    public function getByDeck(DeckDTO $deck): Collection
    {
        $cards = Card::where('deck_id', $deck->id())->with(['deck'])->orderBy('next_revision')->get();

        $cards->transform(function ($item) {
            return CardDTO::fromArray($item->toArray());
        });

        return $cards;
    }

    public function save(CardDTO $card): void
    {
        Card::create([
            'front' => $card->front(),
            'back' => $card->back(),
            'deck_id' => $card->deck()->id(),
        ]);
    }

    public function findById(int $id): CardDTO
    {
        $cardModel = Card::with(['deck'])->find($id);

        if (! $cardModel) {
            throw new CardNotFoundException('Cartão de Estudo não encontrado');
        }

        return CardDTO::fromArray(
            data: $cardModel->toArray()
        );
    }

    public function delete(int $id): void
    {
        Card::destroy($id);
    }

    public function update(CardDTO $card): void
    {
        $cardModel = Card::find($card->id());
        if (! $cardModel) {
            throw new CardNotFoundException('Cartão de Estudo não encontrado');
        }

        $cardModel->update([
            'front' => $card->front(),
            'back' => $card->back(),
            'deck_id' => $card->deck()->id(),
            'next_revision'=> $card->nextRevision(),
        ]);
    }
}
