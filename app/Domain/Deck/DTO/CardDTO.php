<?php

declare(strict_types=1);

namespace Domain\Deck\DTO;

use DateTime;

final class CardDTO
{
    public function __construct(
        private ?int $id,
        private string $front,
        private string $back,
        private ?DateTime $nextRevision
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new CardDTO(
            id: in_array('id', $data) ? (int) $data : null,
            front: $data['front'],
            back: $data['back'],
            nextRevision: $data['next_revision'] ? new DateTime($data['next_revision']) : null
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
}
