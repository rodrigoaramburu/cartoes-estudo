<?php

declare(strict_types=1);

namespace Domain\Deck\DTO;

use DateTime;
use DateTimeZone;

final class CardDTO
{
    public function __construct(
        private string $front,
        private string $back,
        private DeckDTO $deck,
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
            deck: DeckDTO::fromArray($data['deck'])
        );
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
    
    public function changeNextRevision(\DateTime $nextRevision): void
    {
        $this->nextRevision = $nextRevision;
    }

    public function deck(): DeckDTO
    {
        return $this->deck;
    }
}
