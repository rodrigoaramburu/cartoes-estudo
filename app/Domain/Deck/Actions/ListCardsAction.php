<?php

declare(strict_types=1);

namespace Domain\Deck\Actions;

use Domain\Deck\DTO\DeckDTO;
use Domain\Deck\Repositories\CardRepositoryInterface;
use Illuminate\Support\Collection;

final class ListCardsAction
{
    public function __construct(
        private CardRepositoryInterface $cardRepositoryInterface
    ) {
    }

    public function __invoke(DeckDTO $deck): Collection
    {
        return $this->cardRepositoryInterface->getByDeck(deck: $deck);
    }
}
