<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class livreurUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom_utilisateur' => 'sometimes|string|max:255',
            'prenom' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,',
            'password' => 'sometimes|string|min:6',
            'vehicule' => 'sometimes|string',
            'zone' => 'sometimes|string',
        ];
    }
}
