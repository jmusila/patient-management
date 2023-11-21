<?php

namespace App\Http\Controllers;

use App\Actions\RegisterAccount;
use App\Http\Requests\CreateReceptionistRequest;
use App\Http\Requests\UpdateReceptionistRequest;
use App\Http\Resources\ReceptionistResource;
use App\Models\Receptionist;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class ReceptionistController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return ReceptionistResource::collection(Receptionist::with(Receptionist::DEFAULT_RELATIONS)->get());
    }

    public function show(Receptionist $receptionist): ReceptionistResource
    {
        return new ReceptionistResource($receptionist->load(Receptionist::DEFAULT_RELATIONS));
    }

    public function store(CreateReceptionistRequest $request): ReceptionistResource
    {
        $user = (new RegisterAccount())->registerAccount($request);

        $receptionistData = $request->only(['date_of_hire', 'supervisor']);

        $data = array_merge($receptionistData, ['user_id' => $user->id,]);

        $receptionist = Receptionist::create($data);

        return new ReceptionistResource($receptionist->load(Receptionist::DEFAULT_RELATIONS));
    }

    public function update(UpdateReceptionistRequest $request, Receptionist $receptionist): ReceptionistResource
    {
        $receptionist->update($request->validated());

        return new ReceptionistResource($receptionist->load(Receptionist::DEFAULT_RELATIONS));
    }

    public function destroy(Receptionist $patient): Response
    {
        $patient->delete();

        return response()->noContent();
    }
}
