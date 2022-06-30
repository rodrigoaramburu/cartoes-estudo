<?php

declare(strict_types=1);

namespace Domain\Deck\Repositories;

use Illuminate\Support\Collection;

interface DeckRepositoryInterface
{
    public function all(): Collection;
}
