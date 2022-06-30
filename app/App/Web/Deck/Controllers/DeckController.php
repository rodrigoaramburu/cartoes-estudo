<?php

declare(strict_types=1);

namespace App\Web\Deck\Controllers;

use App\Core\Http\Controllers\Controller;
use Domain\Deck\Actions\ListDeckAction;
use Illuminate\Contracts\View\View;

final class DeckController extends Controller
{
    public function index(ListDeckAction $listAction): View
    {
        $decks = $listAction();

        return view('decks.index', compact('decks'));
    }
}
