<?php

declare(strict_types=1);

namespace Domain\Deck\Actions;

use Domain\Deck\Repositories\DeckRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteDeckAction
{
    public function __construct(
        private DeckRepositoryInterface $deckRepository
    ) {
    }

    public function __invoke(int $id)
    {
        $deck = $this->deckRepository->findById(id: $id);
        if (! $deck) {
            throw new NotFoundHttpException('Baralho não encontrado');
        }

        $this->deckRepository->delete(id: $id);
    }
}
