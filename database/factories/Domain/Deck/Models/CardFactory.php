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
        $frontSentence = fake()->sentence();
        $backSentence = fake()->sentence();

        $front = <<<"JSON"
            {
                "time":1662059960377,
                "blocks":[
                    {"id":"vBjYjm-fvP","type":"paragraph","data":{"text":"$frontSentence"},"tunes":{"alignTune":{"alignment":"left"}}}
                    ],
                "version":"2.25.0"
                }
        JSON;
        $back = <<<"JSON"
            {
                "time":1662059960377,
                "blocks":[
                    {"id":"vBjYjm-fvP","type":"paragraph","data":{"text":"$backSentence"},"tunes":{"alignTune":{"alignment":"left"}}}
                    ],
                "version":"2.25.0"
                }
        JSON;
        return [
            'deck_id' => 1,
            'front' => $front,
            'back' => $back,
        ];
    }
}

