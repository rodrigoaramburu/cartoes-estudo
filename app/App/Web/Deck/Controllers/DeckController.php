<?php

declare(strict_types=1);

namespace App\Web\Deck\Controllers;

use Domain\Deck\DTO\DeckDTO;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Domain\Deck\Actions\ListDeckAction;
use Illuminate\Support\Facades\Session;
use App\Core\Http\Controllers\Controller;
use Domain\Deck\Actions\CreateDeckAction;
use App\Web\Deck\Requests\DeckStoreRequest;

final class DeckController extends Controller
{
    public function index(ListDeckAction $listAction): View
    {
        $decks = $listAction();

        return view('decks.index', compact('decks'));
    }


    public function create(): View
    {
        return view('decks.create');
    }

    public function store(DeckStoreRequest $request, CreateDeckAction $createDeckAction): RedirectResponse
    {
        $createDeckAction(
            DeckDTO::fromArray( $request->only(['name']) )
        );
        Session::flash('message-success','O Baralho foi salvo.');
        return redirect()->route('decks.index');
    }
}
