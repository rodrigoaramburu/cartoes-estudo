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
        switch ($revisionStatus) {
            case RevisionStatus::ERROR:
                $interval = 1;
                $nextRevision = (new \DateTime('now'))->modify('+1 min');
                break;
            case RevisionStatus::HARD:
                $interval = ceil($card->deck()->hardIntervalFactor() * $card->lastInterval());
                $nextRevision = (new \DateTime('now'))->modify("+$interval days");
                break;
            case RevisionStatus::NORMAL:
                $interval = ceil($card->deck()->normalIntervalFactor() * $card->lastInterval());
                $nextRevision = (new \DateTime('now'))->modify("+$interval days");
                break;
            case RevisionStatus::EASY:
                $interval = ceil($card->deck()->easyIntervalFactor() * $card->lastInterval());
                $nextRevision = (new \DateTime('now'))->modify("+$interval days");
                break;
        }

        $card->changeLastInterval($interval);
        $card->changeNextRevision($nextRevision);

        $this->cardRepository->update($card);
    }
}
