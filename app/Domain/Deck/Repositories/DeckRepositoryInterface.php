<?php

declare(strict_types=1);

namespace Domain\Deck\Repositories;

use Domain\Deck\DTO\DeckDTO;
use Illuminate\Support\Collection;

interface DeckRepositoryInterface
{
    public function all(): Collection;

    public function save(DeckDTO $deck): DeckDTO;

    public function delete(int $id): void;

    public function findById(int $id): ?DeckDTO;

    public function update(DeckDTO $deck): void;
}
