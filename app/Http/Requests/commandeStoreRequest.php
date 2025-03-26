<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class commandeStoreRequest extends FormRequest
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
            'quantite' => 'required|integer|min:1',
            'instructions' => 'nullable|string|max:500',
            'evaluation' => 'nullable|numeric|min:1|max:5',
            'prixTotal' => 'required|numeric|min:0',
            'cleint_id' => 'required|exists:users,id',
            'livreur_id' => 'required|exists:users,id',
            'restaurant_id' => 'required|exists:restaurants,id',
        ];
    }
}
