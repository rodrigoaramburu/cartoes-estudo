<?php

declare(strict_types=1);

namespace Domain\Deck\Actions;

final class TotalCardsToRevise extends ListCardsToRevise
{
    public function __invoke(int $deckId): int
    {
        // $deck = $this->deckRepository->findById($deckId);

        // $cards = $this->cardRepository->getByDeck(deck: $deck);
        return parent::get($deckId)->count();
    }
}
