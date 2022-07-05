<?php

declare(strict_types=1);

namespace Domain\Deck\Actions;

use Domain\Deck\DTO\DeckDTO;
use Domain\Deck\Repositories\CardRepositoryInterface;
use Domain\Deck\Repositories\DeckRepositoryInterface;
use ZipArchive;

final class ExportDeckAction
{
    public function __construct(
        private CardRepositoryInterface $cardRepository,
        private DeckRepositoryInterface $deckRepository,
    ) {
    }

    public function __invoke(DeckDTO $deck): string
    {
        $cards = $this->cardRepository->getByDeck($deck);

        $data = json_encode([
            'deck' => $deck->name(),
            'cards' => $cards,
        ]);

        $tmpfname = tempnam('/tmp', 'tmpzip');
        $zip = new ZipArchive();
        $zip->open($tmpfname, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        $zip->addFromString('deck.json', $data);
        $zip->close();
        $content = file_get_contents($tmpfname);
        unlink($tmpfname);

        return $content;
    }
}
