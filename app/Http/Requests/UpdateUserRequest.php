<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $user = $this->route('user');

        return [
            'first_name' => ['filled', 'string'],
            'last_name' => ['filled', 'string'],
            'email' => ['filled', 'email', 'unique:users,email,' . $user->id],
            'middle_name' => ['filled', 'string'],
            'phone_number' => ['filled', 'string', 'unique:users,phone_number,' . $user->id],
            'national_id_number' => ['filled', 'string', 'unique:users,national_id_number,' . $user->id],
            'gender' => ['filled', 'string', Rule::in(config('validators.gender'))],
            'address' => ['filled', 'string'],
            'date_of_birth' => ['filled', 'date'],
        ];
    }
}
