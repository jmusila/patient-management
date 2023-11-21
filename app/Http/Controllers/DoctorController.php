<?php

namespace App\Http\Controllers;

use App\Actions\RegisterAccount;
use App\Http\Requests\CreateDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class DoctorController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return DoctorResource::collection(Doctor::with(Doctor::DEFAULT_RELATIONS)->get());
    }

    public function show(Doctor $doctor): DoctorResource
    {
        return new DoctorResource($doctor->load(Doctor::DEFAULT_RELATIONS));
    }

    public function store(CreateDoctorRequest $request): DoctorResource
    {
        $user = (new RegisterAccount())->registerAccount($request);

        $doctorData = $request->only([
            'license_number', 
            'specialization', 
            'date_of_hire',
            'title',
            'experience_years',
            'short_bio'
        ]);

        $data = array_merge($doctorData, ['user_id' => $user->id]);

        $doctor = Doctor::create($data);

        return new DoctorResource($doctor->load(Doctor::DEFAULT_RELATIONS));
    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor): DoctorResource
    {
        $doctor->update($request->validated());

        return new DoctorResource($doctor->load(Doctor::DEFAULT_RELATIONS));
    }

    public function destroy(Doctor $doctor): Response
    {
        $doctor->delete();

        return response()->noContent();
    }
}
