<?php

declare(strict_types=1);

namespace Domain\Deck\DTO;

use Illuminate\Support\Collection;

final class DeckDTO
{
    private Collection $cards;

    public function __construct(
        private string $name,
        private ?int $id = null,
        ?Collection $cards = null
    ) {
        $this->cards = $cards ?? collect();
    }

    public static function fromArray(array $data): self
    {
        return new DeckDTO(
            id: array_key_exists('id', $data) ? (int) $data['id'] : null,
            name: $data['name'],
            cards: $data['cards'] ?? null
        );
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function cards(): ?Collection
    {
        return $this->cards;
    }
}
