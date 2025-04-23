<?php

namespace App\Http\Requests;

use Dotenv\Exception\ValidationException;
use Illuminate\Foundation\Http\FormRequest;

class CategorieResquest extends FormRequest
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
            'mon_categorie' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ];
    }

    // protected function failedValidation( $validator)
    // {
    //     $response = response()->json([
    //         'error' => 'Validation failed',
    //         'messages' => $validator->errors(),
    //     ], 422);

    //     throw new ValidationException($validator, $response);
    // }
}
