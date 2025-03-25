<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlatResquest extends FormRequest
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
            'nom_plat' => 'required|string|max:255',
            'desciption' => 'required|string|max:500',
            'prix' => 'required|numeric|min:0',
            'temps_Preparation' => 'required|integer|min:1',
            'disponible' => 'required|boolean',
            'image' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id'
        ];
    }
}
