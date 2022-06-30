<?php

declare(strict_types=1);

namespace App\Web\Deck\Controllers;

use App\Core\Http\Controllers\Controller;
use Domain\Deck\Actions\ListCardsAction;
use Domain\Deck\Actions\RetrieveDeckAction;
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
}
