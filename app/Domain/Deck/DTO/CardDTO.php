<?php

declare(strict_types=1);

namespace Domain\Deck\DTO;

use DateTime;
use JsonSerializable;

final class CardDTO implements JsonSerializable
{
    public function __construct(
        public readonly string $front,
        public readonly string $back,
        public readonly string $frontHtml,
        public readonly string $backHtml,
        public readonly DeckDTO $deck,
        public readonly float $lastInterval,
        public readonly ?int $id = null,
        public readonly ?DateTime $nextRevision = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new CardDTO(
            id: array_key_exists('id', $data) ? (int) $data['id'] : null,
            front: $data['front'],
            back: $data['back'],
            frontHtml: $data['front_html'] ?? '',
            backHtml: $data['back_html'] ?? '',
            nextRevision: array_key_exists('next_revision', $data) && $data['next_revision'] !== null
                            ? (new DateTime($data['next_revision']))->setTimezone(new \DateTimeZone(env('APP_TIMEZONE')))
                            : null,
            lastInterval: (float) ($data['last_interval'] ?? 0),
            deck: DeckDTO::fromArray($data['deck'])
        );
    }

    public function jsonSerialize(): mixed
    {
        return [
            'front_html' => $this->frontHtml,
            'front' => $this->front,
            'back_html' => $this->backHtml,
            'back' => $this->back,
        ];
    }

   
}
