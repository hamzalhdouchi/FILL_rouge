<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantUpdateRequest extends FormRequest
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
            'nom_Restaurant' => 'sometimes|string|max:255',
            'adresse' => 'sometimes|string|max:255',
            'telephone' => 'sometimes|string|max:20',
            'notation' => 'nullable|numeric',
            'statut' => 'sometimes|in:ouvert,fermé',
            'zone_Livraison' => 'sometimes|string|max:255',
        ];
    }
}
