<?php

declare(strict_types=1);

namespace App\Web\Deck\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class DeckStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:160|unique:decks',
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
