<?php

declare(strict_types=1);

namespace Domain\Deck\Actions;

use DateTime;
use Domain\Deck\DTO\CardDTO;
use Domain\Deck\Repositories\CardRepositoryInterface;
use Domain\Deck\Repositories\DeckRepositoryInterface;

final class NextCardRevisionAction
{
    public function __construct(
        private DeckRepositoryInterface $deckRepository,
        private CardRepositoryInterface $cardRepository,
    ) {
    }

    public function __invoke(int $deckId): ?CardDTO
    {
        $deck = $this->deckRepository->findById($deckId);

        $cards = $this->cardRepository->getByDeck(deck: $deck);

        return $cards
            ->filter(function ($item) {
                return $item->nextRevision() < new DateTime('now') || $item->nextRevision() === null;
            })
            ->sortBy(function ($a) {
                return $a->nextRevision() ?? new DateTime('now');
            })->first();
    }
}
