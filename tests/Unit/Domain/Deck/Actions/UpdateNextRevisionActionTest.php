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
        name : 'Deck Teste'
    );

    $this->deckRepository->shouldReceive('findById')->with(1)->andReturn($this->deck);

    /** @var Mock|CardRepositoryInterface */
    $this->cardRepository = Mockery::mock(CardRepositoryInterface::class);
});

test('deve atualizar o next_revision de um card para +1 HORA se RevisionStatus for ERROR', function () {
    $card = new CardDTO(id: 1, front: 'front1', back: 'brack1', nextRevision: null, deck: $this->deck);

    $this->cardRepository->shouldReceive('update')->with(Mockery::on(function ($card) {
        $date = (new \DateTime('now'))->modify('+1 hour');

        return $card->nextRevision()->format('Y-m-d H:i') == $date->format('Y-m-d H:i');
    }));

    $updateNextRevisionAction = new UpdateNextRevisionAction(
        cardRepository: $this->cardRepository,
    );

    $updateNextRevisionAction(
        card: $card,
        revisionStatus: RevisionStatus::ERROR
    );
});

test('deve atualizar o next_revision de um card para +1 DIA se RevisionStatus for HARD', function () {
    $card = new CardDTO(id: 1, front: 'front1', back: 'brack1', nextRevision: null, deck: $this->deck);

    $this->cardRepository->shouldReceive('update')->with(Mockery::on(function ($card) {
        $date = (new \DateTime('now'))->modify('+1 day');

        return $card->nextRevision()->format('Y-m-d H:i') == $date->format('Y-m-d H:i');
    }));

    $updateNextRevisionAction = new UpdateNextRevisionAction(
        cardRepository: $this->cardRepository,
    );

    $updateNextRevisionAction(
        card: $card,
        revisionStatus: RevisionStatus::HARD
    );
});

test('deve atualizar o next_revision de um card para +2 DIAS se RevisionStatus for NORMAL', function () {
    $card = new CardDTO(id: 1, front: 'front1', back: 'brack1', nextRevision: null, deck: $this->deck);

    $this->cardRepository->shouldReceive('update')->with(Mockery::on(function ($card) {
        $date = (new \DateTime('now'))->modify('+2 days');

        return $card->nextRevision()->format('Y-m-d H:i') == $date->format('Y-m-d H:i');
    }));

    $updateNextRevisionAction = new UpdateNextRevisionAction(
        cardRepository: $this->cardRepository,
    );

    $updateNextRevisionAction(
        card: $card,
        revisionStatus: RevisionStatus::NORMAL
    );
});

test('deve atualizar o next_revision de um card para +4 DIAS se RevisionStatus for EASY', function () {
    $card = new CardDTO(id: 1, front: 'front1', back: 'brack1', nextRevision: null, deck: $this->deck);

    $this->cardRepository->shouldReceive('update')->with(Mockery::on(function ($card) {
        $date = (new \DateTime('now'))->modify('+4 days');

        return $card->nextRevision()->format('Y-m-d H:i') == $date->format('Y-m-d H:i');
    }));

    $updateNextRevisionAction = new UpdateNextRevisionAction(
        cardRepository: $this->cardRepository,
    );

    $updateNextRevisionAction(
        card: $card,
        revisionStatus: RevisionStatus::EASY
    );
});
