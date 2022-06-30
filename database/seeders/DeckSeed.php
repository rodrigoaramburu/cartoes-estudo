<?php

namespace Database\Seeders;

use Domain\Deck\Models\Deck;
use Illuminate\Database\Seeder;

class DeckSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Deck::create([
            'name' => 'Deck exemplo 1',
        ]);
        Deck::create([
            'name' => 'Deck exemplo 2',
        ]);
    }
}
