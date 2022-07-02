<?php

declare(strict_types=1);

namespace App\Web\Deck\Controllers;

use App\Core\Http\Controllers\Controller;
use App\Web\Deck\Requests\CardRequest;
use Domain\Deck\Actions\CreateCardAction;
use Domain\Deck\Actions\DeleteCardAction;
use Domain\Deck\Actions\ListCardsAction;
use Domain\Deck\Actions\ListDeckAction;
use Domain\Deck\Actions\RetrieveCardAction;
use Domain\Deck\Actions\RetrieveDeckAction;
use Domain\Deck\Actions\UpdateCardAction;
use Domain\Deck\DTO\CardDTO;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

final class CardController extends Controller
{
    public function index(
        string $deckId,
        RetrieveDeckAction $retrieveDeckAction,
        ListCardsAction $listCardsAction): View
    {
        $deck = $retrieveDeckAction(id: (int) $deckId);
        $cards = $listCardsAction(deck: $deck);

        return view('cards.index', compact('cards', 'deck'));
    }

    public function create(ListDeckAction $listDecksAction): View
    {
        $decks = $listDecksAction();

        return view('cards.create', compact('decks'));
    }

    public function store(CardRequest $request, CreateCardAction $createCardAction, RetrieveDeckAction $retrieveDeckAction): RedirectResponse
    {
        $deck = $retrieveDeckAction((int) $request->input('deck_id'));

        $createCardAction(
            CardDTO::fromArray(
                array_merge(
                    $request->only(['front', 'back']),
                    ['deck'=>$deck->toArray()]
                )
            )
        );

        Session::flash('message-success', 'O cartão foi adicionado');

        return redirect()->route('cards.index', $deck->id());
    }

    public function delete(string $id, RetrieveCardAction $retrieveCardAction, DeleteCardAction $deleteCardAction): RedirectResponse
    {
        $card = $retrieveCardAction((int) $id);

        $deleteCardAction($card->id());

        Session::flash('message-success', 'O Cartão de Estudo foi deletado.');

        return redirect()->route('cards.index', $card->deck()->id());
    }

    public function edit(string $id, RetrieveCardAction $retrieveCardAction, ListDeckAction $listDecksAction): View
    {
        $card = $retrieveCardAction((int) $id);
        $decks = $listDecksAction();

        return view('cards.edit', compact('decks', 'card'));
    }

    public function update(
        CardRequest $request,
        RetrieveDeckAction $retrieveDeckAction,
        UpdateCardAction $updateCardAction
    ): RedirectResponse {
        $deck = $retrieveDeckAction((int) $request->input('deck_id'));

        $updateCardAction(
            CardDTO::fromArray(
                array_merge(
                    $request->only(['id', 'front', 'back']),
                    ['deck'=>$deck->toArray()]
                )
            )
        );
        Session::flash('message-success', 'O Cartão de Estudos foi alterado');

        return redirect()->route('cards.index', $deck->id());
    }
}
