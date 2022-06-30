<?php

declare(strict_types=1);

namespace App\Web\Deck\Controllers;

use App\Core\Http\Controllers\Controller;
use App\Web\Deck\Requests\DeckRequest;
use Domain\Deck\Actions\CreateDeckAction;
use Domain\Deck\Actions\DeleteDeckAction;
use Domain\Deck\Actions\ListDeckAction;
use Domain\Deck\Actions\RetriveDeckAction;
use Domain\Deck\Actions\UpdateDeckAction;
use Domain\Deck\DTO\DeckDTO;
use Domain\Deck\Exceptions\DeckNotFoundException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function store(DeckRequest $request, CreateDeckAction $createDeckAction): RedirectResponse
    {
        $createDeckAction(
            DeckDTO::fromArray($request->only(['name']))
        );
        Session::flash('message-success', 'O Baralho foi salvo.');

        return redirect()->route('decks.index');
    }

    public function delete(string $id, DeleteDeckAction $deleteDeckAction): RedirectResponse
    {
        try {
            $deleteDeckAction((int) $id);
        } catch (DeckNotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }

        Session::flash('message-success', 'O Baralho foi deletado');

        return redirect()->route('decks.index');
    }

    public function edit(string $id, RetriveDeckAction $retriveDeckAction): View
    {
        try {
            $deck = $retriveDeckAction(id: (int) $id);
        } catch (DeckNotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }

        return view('decks.edit', compact('deck'));
    }

    public function update(DeckRequest $request, string $id, UpdateDeckAction $updateDeckAction): RedirectResponse
    {
        $updateDeckAction(
            DeckDTO::fromArray($request->only(['id', 'name']))
        );

        Session::flash('message-success', 'O Baralho foi alterado');

        return redirect()->route('decks.index');
    }
}
