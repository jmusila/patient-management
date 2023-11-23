<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

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
            "start_date" => ["required", "date_format:Y-m-d H:i"],
            "end_date" => [
                "required", "date_format:Y-m-d H:i", function ($attribute, $value, $fail) {
                    $startAt = Carbon::parse($this->input('start_date'));
                    $endAt = Carbon::parse($value);
                    if ($endAt->lte($startAt) || ! $endAt->isSameDay($startAt)) {
                        $fail('The end date must be a time after start date.');
                    }
                },
            ],
            "visit_reason" => ["required", "string"],
            "reception_notes" => ["filled", "string"],
            "patient_id" => ["required", "integer", "exists:patients,id"],
            "doctor_id" => ["required", "integer", "exists:doctors,id"],
        ];
    }
}