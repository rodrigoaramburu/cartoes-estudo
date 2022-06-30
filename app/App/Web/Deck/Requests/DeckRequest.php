<?php

declare(strict_types=1);

namespace App\Web\Deck\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class DeckRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'min:3',
                'max:160',
                Rule::unique('decks')->ignore($this->id, 'id'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome deve ser preenchido',
            'name.unique' => 'O nome já existe',
            'name.min' => 'O nome deve ter no mínimo 3 caracteres',
            'name.max' => 'O nome deve ter no máximo 160 caracteres',
        ];
    }
}
