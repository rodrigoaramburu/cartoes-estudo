<?php

declare(strict_types=1);

namespace Domain\Deck\Actions;

use Domain\Deck\DTO\CardDTO;
use Domain\Deck\Repositories\CardRepositoryInterface;

final class CreateCardAction
{
    public function __construct(
        private CardRepositoryInterface $cardRepository
    ) {
    }

    public function __invoke(CardDTO $card): void
    {
        $this->cardRepository->save(card: $card);
    }
}
