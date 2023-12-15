<?php

namespace App\Actions;

use App\Enums\Roles;
use App\Enums\Statuses;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class RegisterAccount
{
    public function registerAccount(array $data)
    {
        $hashedPassword = Hash::make($data['password']);

        $userData = $this->userRequestData($data);

        $data = array_merge($userData, ['password' => $hashedPassword, 'status' => Statuses::ACTIVE->value]);

        $user = User::create($data);

        $user->assignRole($data['roles'] ?? []);

        return $user;
    }

    protected function userRequestData(array $data)
    {
        return Arr::only($data, [
            "first_name",
            "last_name",
            "email",
            "date_of_birth",
            "gender",
            "phone_number",
            "national_id_number",
            "password",
            "type",
        ]);
    }
}
