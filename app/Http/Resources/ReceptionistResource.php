<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReceptionistResource extends JsonResource
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
            "staff_number" => $this->staff_number,
            "date_of_hire" => $this->date_of_hire,
            "supervisor" => $this->supervisor,
            "user" => new UserResource($this->whenLoaded("user")),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
