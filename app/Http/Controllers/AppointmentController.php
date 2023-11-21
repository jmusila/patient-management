<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return AppointmentResource::collection(Appointment::latest()->with(Appointment::DEFAULT_RELATIONS)->get());
    }

    public function store(CreateAppointmentRequest $request): AppointmentResource
    {
        $data = $request->validated();

        $appointmentData = array_merge($data, [
            'booked_by' => Auth::id(),
        ]);

        $appointment = Appointment::create($appointmentData);

        return new AppointmentResource($appointment->load(Appointment::DEFAULT_RELATIONS));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment): AppointmentResource
    {
        $appointment->update($request->validated());

        return new AppointmentResource($appointment->load(Appointment::DEFAULT_RELATIONS));
    }

    public function destroy(Appointment $appointment): Response
    {
        $appointment->delete();

        return response()->noContent();
    }
}
