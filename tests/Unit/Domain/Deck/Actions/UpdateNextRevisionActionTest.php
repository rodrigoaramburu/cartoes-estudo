<?php

declare(strict_types=1);

use Domain\Deck\Actions\UpdateNextRevisionAction;
use Domain\Deck\DTO\CardDTO;
use Domain\Deck\DTO\DeckDTO;
use Domain\Deck\DTO\RevisionStatus;
use Domain\Deck\Repositories\CardRepositoryInterface;
use Domain\Deck\Repositories\DeckRepositoryInterface;

beforeEach(function () {

    /** @var Mock|DeckRepositoryInterface */
    $this->deckRepository = Mockery::mock(DeckRepositoryInterface::class);

    $this->deck = new DeckDTO(
        id: 1,
        name: 'Deck Teste',
        hardIntervalFactor: 1.5,
        normalIntervalFactor: 2,
        easyIntervalFactor:  2.5,
    );

    $this->deckRepository->shouldReceive('findById')->with(1)->andReturn($this->deck);

    /** @var Mock|CardRepositoryInterface */
    $this->cardRepository = Mockery::mock(CardRepositoryInterface::class);
});

test('deve atualizar o next_revision de um card para +1 minuto se RevisionStatus for ERROR', function () {
    $card = new CardDTO(id: 1, front: 'front1', frontHtml: 'fronthtml', back: 'brack1', backHtml: 'backhtml', nextRevision: null, deck: $this->deck, lastInterval: 1);

    $this->cardRepository->shouldReceive('update')->with(Mockery::on(function ($card) {
        $date = (new \DateTime('now'))->modify('+1 min');

        return $card->nextRevision->format('Y-m-d H:i') == $date->format('Y-m-d H:i') &&
                $card->lastInterval == 1;
    }));

    $updateNextRevisionAction = new UpdateNextRevisionAction(
        cardRepository: $this->cardRepository,
    );

    $updateNextRevisionAction(
        card: $card,
        revisionStatus: RevisionStatus::ERROR
    );
});

test('deve atualizar o next_revision de um card com RevisionStatus HARD se (lastInterval, nextDay)', function ($lastInterval, $nextInterval) {
    $card = new CardDTO(id: 1, front: 'front1', frontHtml: 'fronthtml', back: 'brack1', backHtml: 'backhtml',  nextRevision: null, deck: $this->deck, lastInterval: $lastInterval);

    $this->cardRepository->shouldReceive('update')->with(Mockery::on(function ($card) use ($nextInterval) {
        $date = (new \DateTime('now'))->modify("+$nextInterval day");

        return $card->nextRevision->format('Y-m-d H:i') == $date->format('Y-m-d H:i') &&
            $card->lastInterval == $nextInterval;
    }));

    $updateNextRevisionAction = new UpdateNextRevisionAction(
        cardRepository: $this->cardRepository,
    );

    $updateNextRevisionAction(
        card: $card,
        revisionStatus: RevisionStatus::HARD
    );
})->with([
    [1, 2],
    [2, 3],
    [3, 5],
]);

test('deve atualizar o next_revision de um card para com RevisionStatus for NORMAL', function ($lastInterval, $nextInterval) {
    $card = new CardDTO(id: 1, front: 'front1', frontHtml: 'fronthtml', back: 'brack1', backHtml: 'backhtml',  nextRevision: null, deck: $this->deck, lastInterval: $lastInterval);

    $this->cardRepository->shouldReceive('update')->with(Mockery::on(function ($card) use ($nextInterval) {
        $date = (new \DateTime('now'))->modify("+$nextInterval days");

        return $card->nextRevision->format('Y-m-d H:i') == $date->format('Y-m-d H:i') &&
        $card->lastInterval == $nextInterval;
    }));

    $updateNextRevisionAction = new UpdateNextRevisionAction(
        cardRepository: $this->cardRepository,
    );

    $updateNextRevisionAction(
        card: $card,
        revisionStatus: RevisionStatus::NORMAL
    );
})->with([
    [1,2],
    [2,4],
    [4,8]
]);

test('deve atualizar o next_revision de um card para com RevisionStatus for EASY', function ($lastInterval, $nextInterval) {
    $card = new CardDTO(id: 1, front: 'front1', frontHtml: 'fronthtml', back: 'brack1', backHtml: 'backhtml', nextRevision: null, deck: $this->deck, lastInterval: $lastInterval);

    $this->cardRepository->shouldReceive('update')->with(Mockery::on(function ($card) use ($nextInterval) {
        $date = (new \DateTime('now'))->modify("+$nextInterval days");

        return $card->nextRevision->format('Y-m-d H:i') == $date->format('Y-m-d H:i') &&
        $card->lastInterval == $nextInterval;
    }));

    $updateNextRevisionAction = new UpdateNextRevisionAction(
        cardRepository: $this->cardRepository,
    );

    $updateNextRevisionAction(
        card: $card,
        revisionStatus: RevisionStatus::EASY
    );
})->with([
    [1, 3],
    [3, 8],
    [8, 20],
]);
