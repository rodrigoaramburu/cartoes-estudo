<?php

declare(strict_types=1);

namespace Domain\Deck\Actions;

use Domain\Deck\DTO\CardDTO;

final class NextCardRevisionAction extends ListCardsToRevise
{
    public function __invoke(int $deckId): ?CardDTO
    {
        return parent::get($deckId)->first();
    }
}
