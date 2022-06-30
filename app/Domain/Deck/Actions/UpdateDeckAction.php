<?php

declare(strict_types=1);

namespace Domain\Deck\Actions;

use Domain\Deck\DTO\DeckDTO;
use Domain\Deck\Repositories\DeckRepositoryInterface;

final class UpdateDeckAction
{
    public function __construct(
        private DeckRepositoryInterface $deckRepository
    ) {
    }

    public function __invoke(DeckDTO $deck): void
    {
        $this->deckRepository->update(deck: $deck);
    }
}
