<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class mettreAJouringredient extends FormRequest
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
            'nom_ingredient' => 'sometimes|string|max:255',
            'stock' => 'sometimes|integer|min:0',
            'unite_mesure' => 'sometimes|string|max:50',
            'plate_id' => 'sometimes|exists:plats,id',
        ];
    }
}
