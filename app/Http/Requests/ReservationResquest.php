<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationResquest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'guests' => 'required|integer|min:1',
            'special_requests' => 'nullable|string',
            'preorder_check' => 'boolean',
            'restaurant_id' => 'required|integer',
            'user_id' => 'required|integer'
        ];
    }
}
