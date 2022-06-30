<?php

declare(strict_types=1);

namespace App\Web\Deck\Controllers;

use App\Core\Http\Controllers\Controller;
use App\Web\Deck\Requests\DeckStoreRequest;
use Domain\Deck\Actions\CreateDeckAction;
use Domain\Deck\Actions\DeleteDeckAction;
use Domain\Deck\Actions\ListDeckAction;
use Domain\Deck\DTO\DeckDTO;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

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
            DeckDTO::fromArray($request->only(['name']))
        );
        Session::flash('message-success', 'O Baralho foi salvo.');

        return redirect()->route('decks.index');
    }

    public function delete(string $id, DeleteDeckAction $deleteDeckAction): RedirectResponse
    {
        $deleteDeckAction((int) $id);
        Session::flash('message-success', 'O Baralho foi deletado');

        return redirect()->route('decks.index');
    }
}
