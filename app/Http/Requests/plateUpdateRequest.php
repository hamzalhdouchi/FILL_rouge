<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class plateUpdateRequest extends FormRequest
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
            'nom_plat' => 'sometimes|required|string|max:255',
            'desciption' => 'sometimes|required|string|max:500',
            'prix' => 'sometimes|required|numeric|min:0',
            'temps_Preparation' => 'sometimes|required|integer|min:1',
            // 'disponible' => 'sometimes|required|boolean',
            'image' => 'sometimes|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
