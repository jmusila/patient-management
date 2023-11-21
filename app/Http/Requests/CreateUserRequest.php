<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string'],
            'middle_name' => ['nullable', 'string'],
            'phone_number' => ['required', 'string', 'unique:users,phone_number'],
            'national_id_number' => ['required', 'string', 'unique:users,national_id_number'],
            'type' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'address' => ['nullable', 'string'],
            'date_of_birth' => ['required', 'date'],
        ];
    }
}