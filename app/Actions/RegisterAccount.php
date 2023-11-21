<?php

namespace App\Actions;

use App\Enums\Roles;
use App\Enums\Statuses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterAccount
{
    public function registerAccount(Request $request)
    {
        $role = $this->appendRole($request);

        $password = $request->password;

        $hashedPass = Hash::make($password);

        $userData = $this->userOnlyData($request);

        $data = array_merge($userData, ['password' => $hashedPass, 'status' => Statuses::ACTIVE->value]);

        $user = User::create($data);

        $user->assignRole($role);

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

    protected function appendRole(Request $request)
    {
        if ($request->has("role")) {
            if ($request->type == "patient") {
                return Roles::PATIENT;
            }
            if ($request->type == "doctor") {
                return Roles::DOCTOR;
            }
            if ($request->type == "receptionist") {
                return Roles::RECEPTIONIST;
            }
            if ($request->type == "user") {
                return Roles::USER;
            }
        }
    }
}