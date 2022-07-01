<?php

declare(strict_types=1);

namespace Domain\Deck\Repositories;

use Domain\Deck\DTO\CardDTO;
use Domain\Deck\DTO\DeckDTO;
use Illuminate\Support\Collection;

interface CardRepositoryInterface
{
    public function getByDeck(DeckDTO $deck): Collection;

    public function save(CardDTO $card): void;

    public function findById(int $id): CardDTO;

    public function delete(int $id): void;
}
