<?php

declare(strict_types=1);

namespace Database\Factories\Domain\Deck\Models;

use Domain\Deck\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardFactory extends Factory
{
    protected $model = Card::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'deck_id' => 1,
            'front' => fake()->sentence(),
            'back' => fake()->sentence(),
        ];
    }
}
