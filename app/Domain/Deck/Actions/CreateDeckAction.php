<?php

declare(strict_types=1);

namespace Domain\Deck\Actions;

use Domain\Deck\DTO\DeckDTO;
use Domain\Deck\Repositories\DeckRepositoryInterface;

final class CreateDeckAction
{
    public function __construct(
        private DeckRepositoryInterface $deckRepository
    ){}

    public function __invoke(DeckDTO $deck)
    {
        $this->deckRepository->save( deck: $deck);
    }
}
