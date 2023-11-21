<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class UserResource extends JsonResource
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
            "first_name" => $this->first_name,
            "middle_name" => $this->middle_name,
            "last_name" => $this->last_name,
            "email"=> $this->email,
            "phone_number" => $this->phone_number,
            "gender" => $this->gender,
            "date_of_birth" => Carbon::parse($this->date_of_birth)->toDateTimeString(),
            "address" => $this->address,
            "type" => $this->type,
            "roles" => RoleResource::collection($this->whenLoaded('roles')),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}