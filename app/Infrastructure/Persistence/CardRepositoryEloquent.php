<?php

declare(strict_types=1);

namespace Infrastructure\Persistence;

use Domain\Deck\DTO\CardDTO;
use Domain\Deck\DTO\DeckDTO;
use Domain\Deck\Models\Card;
use Domain\Deck\Repositories\CardRepositoryInterface;
use Illuminate\Support\Collection;

final class CardRepositoryEloquent implements CardRepositoryInterface
{
    public function getByDeck(DeckDTO $deck): Collection
    {
        $cards = Card::where('deck_id', $deck->id())->get();

        $cards->transform(function ($item) {
            return CardDTO::fromArray($item->toArray());
        });

        return $cards;
    }
}
