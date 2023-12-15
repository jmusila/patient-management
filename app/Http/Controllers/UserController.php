<?php

namespace App\Http\Controllers;

use App\Actions\RegisterAccount;
use App\Enums\Statuses;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        return UserResource::collection(User::with(User::DEFAULT_RELATIONSHIPS)->get());
    }

    public function store(CreateUserRequest $request): UserResource
    {
        $user = (new RegisterAccount())->registerAccount($request->validated());

        return new UserResource($user->load(User::DEFAULT_RELATIONSHIPS));
    }

    public function show(): UserResource
    {
        $user = Auth::user();

        tap($user)->load(User::DEFAULT_RELATIONSHIPS);

        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, User $user): UserResource
    {
        $user->update($request->validated());

        return new UserResource($user->load(User::DEFAULT_RELATIONSHIPS));
    }

    public function destroy(User $user): Response
    {
        $user->delete();

        return response()->noContent();
    }
}
