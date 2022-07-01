<?php

declare(strict_types=1);

namespace App\Web\Deck\Controllers;

use App\Core\Http\Controllers\Controller;
use App\Web\Deck\Requests\CardRequest;
use Domain\Deck\Actions\CreateCardAction;
use Domain\Deck\Actions\ListCardsAction;
use Domain\Deck\Actions\ListDeckAction;
use Domain\Deck\Actions\RetrieveDeckAction;
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

    public function create(ListDeckAction $listCardsAction): View
    {
        $decks = $listCardsAction();

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
}
