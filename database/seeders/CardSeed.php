<?php

namespace Database\Seeders;

use Domain\Deck\Models\Card;
use Illuminate\Database\Seeder;

class CardSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Card::create([
            'deck_id' => 1,
            'front' => 'Pergunta 1',
            'back' => 'Restposta 1',
        ]);

        Card::create([
            'deck_id' => 1,
            'front' => 'Pergunta 2',
            'back' => 'Restposta 2',
        ]);

        Card::create([
            'deck_id' => 1,
            'front' => 'Pergunta 3',
            'back' => 'Restposta 4',
        ]);
    }
}
