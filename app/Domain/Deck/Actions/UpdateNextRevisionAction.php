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
    ){}

    public function __invoke(CardDTO $card, RevisionStatus $revisionStatus): void
    {
        $data = match($revisionStatus){
            RevisionStatus::ERROR => (new \DateTime('now'))->modify('+1 hour'),
            RevisionStatus::HARD => (new \DateTime('now'))->modify('+1 day'),
            RevisionStatus::NORMAL => (new \DateTime('now'))->modify('+2 days'),
            RevisionStatus::EASY => (new \DateTime('now'))->modify('+4 days'),

        };

        $card->changeNextRevision($data);

        $this->cardRepository->update($card);
    }
}

