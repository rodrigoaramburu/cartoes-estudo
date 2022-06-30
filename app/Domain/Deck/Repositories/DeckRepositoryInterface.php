<?php

declare(strict_types=1);

namespace Domain\Deck\Repositories;

use Domain\Deck\DTO\DeckDTO;
use Illuminate\Support\Collection;

interface DeckRepositoryInterface
{
    public function all(): Collection;
    public function save(DeckDTO $deck): void;
}
