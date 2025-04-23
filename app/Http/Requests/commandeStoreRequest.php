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
            'prixTotal' => 'nullable|numeric|min:0',
            'table_number' => 'nullable|integer|min:0',
            'restaurant_id' => 'required|exists:restaurants,id',
        ];
    }
}
