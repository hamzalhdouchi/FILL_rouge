<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class reservationUpdateRequest extends FormRequest
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
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email',
            'phone' => 'sometimes|required|string',
            'date' => 'sometimes|required|date',
            'time' => 'sometimes|required',
            'guests' => 'sometimes|required|integer|min:1',
            'special_requests' => 'nullable|string',
            'preorder_check' => 'boolean',
            'restaurant_id' => 'sometimes',
            'user_id' => 'sometimes'
        ];
    }
}
