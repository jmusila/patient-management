<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "patient_number" => $this->patient_number,
            "patient_type" => $this->patient_type,
            "approval_status" => $this->approval_status,
            "user" => new UserResource($this->whenLoaded("user")),
            "emergency_contact" => $this->emergency_contact,
            "first_visit_date" => $this->first_visit_date,
        ];
    }
}
