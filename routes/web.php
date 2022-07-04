<?php

use App\Web\Deck\Controllers\CardController;
use App\Web\Deck\Controllers\DeckController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/decks', [DeckController::class, 'index'])->name('decks.index');
Route::get('/decks/create', [DeckController::class, 'create'])->name('decks.create');
Route::post('/decks/store', [DeckController::class, 'store'])->name('decks.store');
Route::delete('/decks/delete/{id}', [DeckController::class, 'delete'])->name('decks.delete');
Route::get('/decks/edit/{id}', [DeckController::class, 'edit'])->name('decks.edit');
Route::put('/decks/edit/{id}', [DeckController::class, 'update'])->name('decks.update');

Route::get('/decks/{deckId}/cards', [CardController::class, 'index'])->name('cards.index');
Route::get('/cards/create', [CardController::class, 'create'])->name('cards.create');
Route::post('/cards/store', [CardController::class, 'store'])->name('cards.store');
Route::delete('/cards/{id}', [CardController::class, 'delete'])->name('cards.delete');
Route::get('/cards/{id}', [CardController::class, 'edit'])->name('cards.edit');
Route::put('/cards/{id}', [CardController::class, 'update'])->name('cards.update');

Route::get('/decks/{idDeck}/revision', [CardController::class, 'nextRevision'])->name('cards.next-revision');
Route::post('/decks/{idDeck}/revision', [CardController::class, 'nextRevisionStore'])->name('cards.nex-revision-store');