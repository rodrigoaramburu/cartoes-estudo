<?php

declare(strict_types=1);

namespace App\Web\Deck\Controllers;

use Illuminate\Support\Str;
use Domain\Deck\DTO\DeckDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Web\Deck\Requests\DeckRequest;
use Domain\Deck\Actions\ListDeckAction;
use Illuminate\Support\Facades\Session;
use App\Core\Http\Controllers\Controller;
use Domain\Deck\Actions\CreateDeckAction;
use Domain\Deck\Actions\DeleteDeckAction;
use Domain\Deck\Actions\ExportDeckAction;
use Domain\Deck\Actions\UpdateDeckAction;
use Domain\Deck\Actions\RetrieveDeckAction;
use Domain\Deck\Actions\ImportarBaralhoAction;
use Domain\Deck\Exceptions\DeckNotFoundException;
use Domain\Deck\Exceptions\DeckInvalidFormatException;
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

    public function edit(string $id, RetrieveDeckAction $retrieveDeckAction): View
    {
        try {
            $deck = $retrieveDeckAction(id: (int) $id);
        } catch (DeckNotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }

        return view('decks.edit', compact('deck'));
    }

    public function update(DeckRequest $request, UpdateDeckAction $updateDeckAction): RedirectResponse
    {
        $updateDeckAction(
            DeckDTO::fromArray($request->only(['id', 'name']))
        );

        Session::flash('message-success', 'O Baralho foi alterado');

        return redirect()->route('decks.index');
    }

    public function export(
        string $id,
        RetrieveDeckAction $retrieveDeckAction,
        ExportDeckAction $exportDeckAction
    ): Response {
        $deck = $retrieveDeckAction((int) $id);
        $content = $exportDeckAction($deck);

        return response(
            content: $content,
            status: 200,
            headers: [
                'Content-type' => 'application/zip',
                'Content-disposition' => 'attachment; filename="'.Str::slug($deck->name()).'.zdeck"',
            ]
        );
    }

    public function import(Request $request, ImportarBaralhoAction $importarBaralhoAction): RedirectResponse
    {
        try {
            $importarBaralhoAction(path: $request->file('deck-file')->getRealPath());
        } catch (DeckInvalidFormatException $e) {
            Session::flash('message-error', $e->getMessage());
        }

        Session::flash('message-success', 'O Baralho foi importado com sucesso.');

        return redirect()->route('decks.index');
    }
}
