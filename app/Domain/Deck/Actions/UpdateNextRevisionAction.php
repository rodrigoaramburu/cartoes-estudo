<?php

declare(strict_types=1);

namespace Domain\Deck\Actions;

use Domain\Deck\DTO\CardDTO;
use Domain\Deck\DTO\RevisionStatus;
use Domain\Deck\Repositories\CardRepositoryInterface;

final class UpdateNextRevisionAction
{
    public function __construct(
        private CardRepositoryInterface $cardRepository
    ) {
    }

    public function __invoke(CardDTO $card, RevisionStatus $revisionStatus): void
    {
        if ($revisionStatus == RevisionStatus::ERROR) {
            $nextRevision = (new \DateTime('now'))->modify('+1 min');
            $nextInterval = ceil( $card->lastInterval / 2);
        }else{
            $factor = match($revisionStatus){
                RevisionStatus::HARD => $card->deck->hardIntervalFactor,
                RevisionStatus::NORMAL => $card->deck->normalIntervalFactor,
                RevisionStatus::EASY => $card->deck->easyIntervalFactor
            };
            $nextInterval = $card->lastInterval != 0 
                ? ceil( $factor * $card->lastInterval)
                : 1;

            $nextRevision = (new \DateTime('now'))->modify("+$nextInterval days");
        }

        $this->cardRepository->update(new CardDTO(
            id: $card->id,
            front: $card->front,
            back: $card->back,
            frontHtml: $card->frontHtml,
            backHtml: $card->backHtml,
            nextRevision: $nextRevision,
            lastInterval: $nextInterval,
            deck: $card->deck
        ));
    }
}
