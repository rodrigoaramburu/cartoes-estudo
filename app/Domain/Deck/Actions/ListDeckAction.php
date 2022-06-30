<?php

declare(strict_types=1);

namespace Domain\Deck\Actions;

use Illuminate\Support\Collection;
use Infrastructure\Persistence\DeckRepositoryEloquent;

final class ListDeckAction
{
    public function __construct(
        private DeckRepositoryEloquent $deckRepository
    ) {
    }

    public function __invoke(): Collection
    {
        return $this->deckRepository->all();
    }
}
