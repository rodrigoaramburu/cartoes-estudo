<?php

declare(strict_types=1);

use Domain\Deck\Actions\NextCardRevisionAction;
use Domain\Deck\DTO\CardDTO;
use Domain\Deck\DTO\DeckDTO;
use Domain\Deck\Repositories\CardRepositoryInterface;
use Domain\Deck\Repositories\DeckRepositoryInterface;

beforeEach(function () {

    /** @var Mock|DeckRepositoryInterface */
    $this->deckRepository = Mockery::mock(DeckRepositoryInterface::class);

    $this->deck = new DeckDTO(
        id: 1,
        name : 'Deck Teste',
        hardIntervalFactor: 1.5,
        normalIntervalFactor: 2,
        easyIntervalFactor: 2.5,
    );

    $this->deckRepository->shouldReceive('findById')->with(1)->andReturn($this->deck);

    /** @var Mock|CardRepositoryInterface */
    $this->cardRepository = Mockery::mock(CardRepositoryInterface::class);
});

test('deve retornar 1 se nenhum card já foi revisado', function () {
    $this->cardRepository->shouldReceive('getByDeck')->with($this->deck)->andReturn(collect([
        new CardDTO(id: 1, front: 'front1', frontHtml: 'fronthtml1', back: 'brack1', backHtml: 'backhtml1', nextRevision: null, deck: $this->deck, lastInterval: 1),
        new CardDTO(id: 2, front: 'front2', frontHtml: 'fronthtml2', back: 'brack2', backHtml: 'backhtml2', nextRevision: null, deck: $this->deck, lastInterval: 1),
        new CardDTO(id: 3, front: 'front3', frontHtml: 'fronthtml3', back: 'brack3', backHtml: 'backhtml3', nextRevision: null, deck: $this->deck, lastInterval: 1),
    ]));

    $nextCardRevisionAction = new NextCardRevisionAction(
        deckRepository: $this->deckRepository,
        cardRepository: $this->cardRepository,
    );

    $card = $nextCardRevisionAction(1);

    expect($card->id)->toBe(1);
});

test('deve retornar revisão mais atrasada', function () {
    $nr1 = (new DateTime('now'))->modify('-4 hours');
    $nr2 = (new DateTime('now'))->modify('-6 hours');
    $nr3 = (new DateTime('now'))->modify('-5 hours');

    $this->cardRepository->shouldReceive('getByDeck')->with($this->deck)->andReturn(collect([
        new CardDTO(id: 1, front: 'front1', frontHtml: 'fronthtml1', back: 'brack1', backHtml: 'backhtml1', nextRevision: $nr1, deck: $this->deck, lastInterval: 1),
        new CardDTO(id: 2, front: 'front2', frontHtml: 'fronthtml2', back: 'brack2', backHtml: 'backhtml2', nextRevision: $nr2, deck: $this->deck, lastInterval: 1),
        new CardDTO(id: 3, front: 'front3', frontHtml: 'fronthtml3', back: 'brack3', backHtml: 'backhtml3', nextRevision: $nr3, deck: $this->deck, lastInterval: 1),
    ]));

    $nextCardRevisionAction = new NextCardRevisionAction(
        deckRepository: $this->deckRepository,
        cardRepository: $this->cardRepository,
    );

    $card = $nextCardRevisionAction(1);

    expect($card->id)->toBe(2);
});

test('deve retornar revisão mais atrasada antes de card não revisado', function () {
    $nr1 = (new DateTime('now'))->modify('-4 hours');

    $this->cardRepository->shouldReceive('getByDeck')->with($this->deck)->andReturn(collect([
        new CardDTO(id: 1, front: 'front1', frontHtml: 'fronthtml1', back: 'brack1', backHtml: 'backhtml1', nextRevision: null, deck: $this->deck, lastInterval: 1),
        new CardDTO(id: 2, front: 'front2', frontHtml: 'fronthtml2', back: 'brack2', backHtml: 'backhtml2', nextRevision: $nr1, deck: $this->deck, lastInterval: 1),
        new CardDTO(id: 3, front: 'front3', frontHtml: 'fronthtml3', back: 'brack3', backHtml: 'backhtml3', nextRevision: null, deck: $this->deck, lastInterval: 1),
    ]));

    $nextCardRevisionAction = new NextCardRevisionAction(
        deckRepository: $this->deckRepository,
        cardRepository: $this->cardRepository,
    );

    $card = $nextCardRevisionAction(1);

    expect($card->id)->toBe(2);
});

test('deve retornar null se next revision for maior que data atual', function () {
    $nr1 = (new DateTime('now'))->modify('+1 hours');
    $nr2 = (new DateTime('now'))->modify('+2 hours');
    $nr3 = (new DateTime('now'))->modify('+3 hours');

    $this->cardRepository->shouldReceive('getByDeck')->with($this->deck)->andReturn(collect([
        new CardDTO(id: 1, front: 'front1', frontHtml: 'fronthtml1', back: 'brack1', backHtml: 'backhtml1', nextRevision: $nr1, deck: $this->deck, lastInterval: 1),
        new CardDTO(id: 2, front: 'front2', frontHtml: 'fronthtml2', back: 'brack2', backHtml: 'backhtml2', nextRevision: $nr2, deck: $this->deck, lastInterval: 1),
        new CardDTO(id: 3, front: 'front3', frontHtml: 'fronthtml3', back: 'brack3', backHtml: 'backhtml3', nextRevision: $nr3, deck: $this->deck, lastInterval: 1),
    ]));

    $nextCardRevisionAction = new NextCardRevisionAction(
        deckRepository: $this->deckRepository,
        cardRepository: $this->cardRepository,
    );

    $card = $nextCardRevisionAction(1);

    expect($card)->toBeNull(2);
});
