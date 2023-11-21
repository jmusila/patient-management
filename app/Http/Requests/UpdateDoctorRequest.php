<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorRequest extends FormRequest
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
            'license_number' => ['required', 'string'],
            'specialization' => ['required', 'string'],
            'date_of_hire' => ['required', 'string'],
            'title' => ['required', 'string'],
            'experience_years' => ['filled', 'string'],
            'short_bio'=> ['filled', 'string'],
        ];
    }
}
