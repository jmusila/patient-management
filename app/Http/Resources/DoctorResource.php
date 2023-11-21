<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
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
            "license_number" => $this->license_number,
            "specialization" => $this->specialization,
            "date_of_hire" => $this->date_of_hire,
            "user" => new UserResource($this->whenLoaded("user")),
            "title" => $this->title,
            "experience_years" => $this->experience_years,
            "short_bio" => $this->short_bio,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}