<?php

declare(strict_types=1);

namespace Domain\Deck\Actions;

use Domain\Deck\DTO\CardDTO;
use Domain\Deck\Repositories\CardRepositoryInterface;

final class RetrieveCardAction
{
    public function __construct(
        private CardRepositoryInterface $cardRepository
    ) {
    }

    public function __invoke(int $id): CardDTO
    {
        return $this->cardRepository->findById(id: $id);
    }
}
