<?php

declare(strict_types=1);

namespace Domain\Deck\Actions;

use Domain\Deck\DTO\DeckDTO;
use Domain\Deck\Repositories\DeckRepositoryInterface;

final class RetriveDeckAction
{
    public function __construct(
        private DeckRepositoryInterface $deckRepository
    ) {
    }

    public function __invoke(int $id): DeckDTO
    {
        return $this->deckRepository->findById(id: $id);
    }
}
