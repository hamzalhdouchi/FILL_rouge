<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class platupdateRequest extends FormRequest
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
            'nom_plat' => 'sometimes|string|max:255',
            'desciption' => 'sometimes|string',
            'prix' => 'sometimes|numeric',
            'categorie_id' => 'sometimes|exists:categories,id',
            'temps_Preparation' => 'sometimes|string|max:255',
            'menu_id' => 'sometimes|exists:menus,id',
            'image' => 'sometimes|image|max:2048',
        ];
    }
}
