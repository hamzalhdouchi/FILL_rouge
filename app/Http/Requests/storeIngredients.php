<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeIngredients extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'ingredients' => 'required|array|min:1',
        'ingredients.*.nom_ingredient' => 'required|string|max:255',
        'ingredients.*.stock' => 'required|integer|min:0',
        'ingredients.*.unite_mesure' => 'required|string|max:50',

        ];
    }
}
