<?php

declare(strict_types=1);

namespace Domain\Deck\DTO;

use DateTime;

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
            id: in_array('id', $data) ? (int) $data : null,
            front: $data['front'],
            back: $data['back'],
            nextRevision: in_array('next_revision', $data) ? new DateTime($data['next_revision']) : null,
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

    public function deck(): DeckDTO
    {
        return $this->deck;
    }
}
