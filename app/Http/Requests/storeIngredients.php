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
            'ingredients' => 'required|array',  // Vérifie que 'ingredients' est bien un tableau
            'ingredients.*.nom_ingredient' => 'required|string', // Valide le nom de chaque ingrédient
            'ingredients.*.stock' => 'required|integer', // Valide le stock de chaque ingrédient
            'ingredients.*.unite_mesure' => 'required|string', // Valide l'unité de mesure de chaque ingrédient

        ];
    }
}
