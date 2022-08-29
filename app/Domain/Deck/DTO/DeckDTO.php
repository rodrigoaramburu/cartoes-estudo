<?php

declare(strict_types=1);

namespace Domain\Deck\DTO;

use Illuminate\Support\Collection;

final class DeckDTO
{
    private Collection $cards;

    public function __construct(
        private string $name,
        private float $hardIntervalFactor,
        private float $normalIntervalFactor,
        private float $easyIntervalFactor,
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
            hardIntervalFactor: (float) ($data['hard_interval_factor'] ?? 1.5),
            normalIntervalFactor: (float) ($data['normal_interval_factor'] ?? 2),
            easyIntervalFactor: (float) ($data['easy_interval_factor'] ?? 2.5),
            cards: $data['cards'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'hardIntervalFactor' => $this->hardIntervalFactor,
            'normalIntervalFactor' => $this->normalIntervalFactor,
            'easyIntervalFactor' => $this->easyIntervalFactor,
        ];
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function changeId(int $id): void
    {
        $this->id = $id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function cards(): ?Collection
    {
        return $this->cards;
    }

    public function hardIntervalFactor(): float
    {
        return $this->hardIntervalFactor;
    }

    public function normalIntervalFactor(): float
    {
        return $this->normalIntervalFactor;
    }

    public function easyIntervalFactor(): float
    {
        return $this->easyIntervalFactor;
    }
}
