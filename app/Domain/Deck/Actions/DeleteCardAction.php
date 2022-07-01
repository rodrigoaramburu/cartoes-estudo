<?php

declare(strict_types=1);

namespace Domain\Deck\Actions;

use Domain\Deck\Exceptions\CardNotFoundException;
use Domain\Deck\Repositories\CardRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class DeleteCardAction
{
    public function __construct(
        private CardRepositoryInterface $cardRepository
    ) {
    }

    public function __invoke(int $id)
    {
        try {
            $card = $this->cardRepository->findById(id: $id);
        } catch (CardNotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }

        $this->cardRepository->delete(id: $id);
    }
}
