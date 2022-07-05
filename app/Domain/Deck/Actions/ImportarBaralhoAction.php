<?php

declare(strict_types=1);

namespace Domain\Deck\Actions;

use Domain\Deck\DTO\CardDTO;
use Domain\Deck\DTO\DeckDTO;
use Domain\Deck\Exceptions\DeckInvalidFormatException;
use Domain\Deck\Repositories\CardRepositoryInterface;
use Domain\Deck\Repositories\DeckRepositoryInterface;

final class ImportarBaralhoAction
{
    public function __construct(
        private DeckRepositoryInterface $deckRepository,
        private CardRepositoryInterface $cardRepository,
    ) {
    }

    public function __invoke(string $path): void
    {
        try {
            $zip = new \ZipArchive();
            $zip->open($path);
            $deckJson = json_decode($zip->getFromName('deck.json'), true);
        } catch (\Throwable $e) {
            throw new DeckInvalidFormatException('Error ao Importar Baralho: Formato de Arquivo Inválido');
        }

        $deck = new DeckDTO(
            name: $deckJson['deck']
        );
        $this->deckRepository->save($deck);

        foreach ($deckJson['cards'] as $card) {
            $this->cardRepository->save(new CardDTO(
                front: $card['front'],
                back: $card['back'],
                deck: $deck
            ));
        }
    }
}
