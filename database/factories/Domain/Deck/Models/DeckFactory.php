<?php

namespace Database\Factories\Domain\Deck\Models;

use Domain\Deck\Models\Deck;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeckFactory extends Factory
{
    protected $model = Deck::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => str_replace( "'","", fake()->name()),
        ];
    }
}
