<?php

namespace App\Actions;

use App\Enums\Statuses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterAccount
{
    public function registerAccount(Request $request)
    {
        $password = $request->password;

        $hashedPass = Hash::make($password);

        $data = array_merge($request->validated(), ['password' => $hashedPass, 'status' => Statuses::ACTIVE->value]);

        $user = User::create($data);

        return $user;
    }
}