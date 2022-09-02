<?php

declare(strict_types=1);

namespace Domain\Deck\Actions;

final class TotalCardsToRevise extends ListCardsToRevise
{
    public function __invoke(int $deckId): int
    {
        return parent::get($deckId)->count();
    }
}
