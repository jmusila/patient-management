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
        $hashedPassword = Hash::make($request->password);

        $userData = $this->userRequestData($request);

        $data = array_merge($userData, ['password' => $hashedPassword, 'status' => Statuses::ACTIVE->value]);

        $user = User::create($data);
        
        $user->assignRole($request->roles);

        return $user;
    }

    protected function userRequestData(Request $request)
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
