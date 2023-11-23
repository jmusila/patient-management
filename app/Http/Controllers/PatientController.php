<?php

namespace App\Http\Controllers;

use App\Actions\RegisterAccount;
use App\Http\Filters\PatientFilter;
use App\Http\Requests\CreatePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PatientController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $patients = Patient::with(Patient::DEFAULT_RELATIONS);

        PatientFilter::applyTo($patients, PatientFilter::filters($request));

        return PatientResource::collection($patients->get());
    }

    public function show(Patient $patient): PatientResource
    {
        return new PatientResource($patient->load(Patient::DEFAULT_RELATIONS));
    }

    public function store(CreatePatientRequest $request): PatientResource
    {
        $user = (new RegisterAccount())->registerAccount($request);

        $patientData = $request->only(['patient_type', 'approval_status', 'emergency_contact']);

        $data = array_merge($patientData, [
            'first_visit_date' => Carbon::now(),
            'patient_number' => generatePatientNumber(),
            'user_id' => $user->id,
        ]);

        $patient = Patient::create($data);

        return new PatientResource($patient->load(Patient::DEFAULT_RELATIONS));
    }

    public function update(UpdatePatientRequest $request, Patient $patient): PatientResource
    {
        $patient->update($request->validated());

        return new PatientResource($patient->load(Patient::DEFAULT_RELATIONS));
    }

    public function destroy(Patient $patient): Response
    {
        $patient->delete();

        return response()->noContent();
    }
}
