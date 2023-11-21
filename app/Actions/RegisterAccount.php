<?php

namespace App\Actions;

use App\Enums\Roles;
use App\Enums\Statuses;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterAccount
{
    public function registerAccount(Request $request)
    {
        $roles = $request->roles;

        $password = $request->password;

        $hashedPass = Hash::make($password);

        $userData = $this->userOnlyData($request);

        $data = array_merge($userData, ['password' => $hashedPass, 'status' => Statuses::ACTIVE->value]);

        $user = User::create($data);

        $user->assignRole($roles);

        return $user;
    }

    protected function userOnlyData(Request $request)
    {
        return $request->only([
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