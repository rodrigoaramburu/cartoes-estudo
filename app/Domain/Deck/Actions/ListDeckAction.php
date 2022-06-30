<?php

declare(strict_types=1);

namespace Domain\Deck\Actions;

use Domain\Deck\Repositories\DeckRepositoryInterface;
use Illuminate\Support\Collection;

final class ListDeckAction
{
    public function __construct(
        private DeckRepositoryInterface $deckRepository
    ) {
    }

    public function __invoke(): Collection
    {
        return $this->deckRepository->all();
    }
}
