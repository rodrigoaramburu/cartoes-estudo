<?php

declare(strict_types=1);

namespace Domain\Deck\DTO;

use DateTime;
use JsonSerializable;

final class CardDTO implements JsonSerializable
{
    public function __construct(
        private string $front,
        private string $back,
        private DeckDTO $deck,
        private float $lastInterval,
        private ?int $id = null,
        private ?DateTime $nextRevision = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new CardDTO(
            id: array_key_exists('id', $data) ? (int) $data['id'] : null,
            front: $data['front'],
            back: $data['back'],
            nextRevision: array_key_exists('next_revision', $data) && $data['next_revision'] !== null
                            ? (new DateTime($data['next_revision']))->setTimezone(new \DateTimeZone(env('APP_TIMEZONE')))
                            : null,
            lastInterval: (float) ($data['last_interval'] ?? 1),
            deck: DeckDTO::fromArray($data['deck'])
        );
    }

    public function jsonSerialize(): mixed
    {
        return [
            'front' => $this->front(),
            'back' => $this->back(),
        ];
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function front(): string
    {
        return $this->front;
    }

    public function back(): string
    {
        return $this->back;
    }

    public function nextRevision(): ?DateTime
    {
        return $this->nextRevision;
    }

    public function changeNextRevision(DateTime $nextRevision): void
    {
        $this->nextRevision = $nextRevision;
    }

    public function changeLastInterval(float $lastInterval): void
    {
        $this->lastInterval = $lastInterval;
    }

    public function deck(): DeckDTO
    {
        return $this->deck;
    }

    public function lastInterval(): float
    {
        return $this->lastInterval;
    }
}
