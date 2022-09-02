<?php

declare(strict_types=1);

namespace Domain\Deck\DTO;

use Illuminate\Support\Collection;

final class DeckDTO
{
    public readonly Collection $cards;

    public function __construct(
        public readonly string $name,
        public readonly float $hardIntervalFactor,
        public readonly float $normalIntervalFactor,
        public readonly float $easyIntervalFactor,
        public readonly ?int $id = null,
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

   
}
