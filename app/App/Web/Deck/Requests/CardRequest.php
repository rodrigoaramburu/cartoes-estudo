<?php

declare(strict_types=1);

namespace App\Web\Deck\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class CardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'front' => ['required'],
            'back' => ['required'],
            'deck_id' => ['required', 'exists:decks,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'front.required' => 'A frente do cartão deve ser preenchida',
            'back.required' => 'O verso do cartão deve ser preenchido',
            'deck_id.required' => 'O Baralho do cartão deve ser selecionado',
            'deck_id.exists' => 'O Baralho selecionado é inválido',
        ];
    }
}
