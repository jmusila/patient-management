<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAppointmentRequest extends FormRequest
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
            "start_date" => ["required", "date"],
            "end_date" => ["required_with:start_date", "date"],
            "visit_reason" => ["required", "string"],
            "reception_notes" => ["filled", "string"],
            "patient_id" => ["required", "integer", "exists:patients,id"],
            "doctor_id" => ["required", "integer", "exists:doctors,id"],
        ];
    }
}