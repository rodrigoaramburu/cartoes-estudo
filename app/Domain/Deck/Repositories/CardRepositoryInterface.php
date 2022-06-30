<?php

declare(strict_types=1);

namespace Domain\Deck\Repositories;

use Domain\Deck\DTO\DeckDTO;
use Illuminate\Support\Collection;

interface CardRepositoryInterface
{
    public function getByDeck(DeckDTO $deck): Collection;
}
