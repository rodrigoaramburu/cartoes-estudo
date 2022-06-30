<?php

declare(strict_types=1);

namespace Domain\Deck\Actions;

use Illuminate\Support\Collection;
use Domain\Deck\Repositories\DeckRepositoryInterface;

final class ListDeckAction
{
    public function __construct(
        private DeckRepositoryInterface $deckRepository
    ) {}

    public function __invoke(): Collection
    {
        return $this->deckRepository->all();
    }
}
