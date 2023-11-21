<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAppointmentNoteRequest;
use App\Http\Requests\UpdateAppointmentNoteRequest;
use App\Http\Resources\AppointmentNoteResource;
use App\Models\AppointmentNote;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class AppointmentNoteController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return AppointmentNoteResource::collection(AppointmentNote::latest()->with(AppointmentNote::DEFAULT_RELATIONS)->get());
    }

    public function store(CreateAppointmentNoteRequest $request): AppointmentNoteResource
    {
        $appointment = AppointmentNote::create($request->validated());

        return new AppointmentNoteResource($appointment->load(AppointmentNote::DEFAULT_RELATIONS));
    }

    public function update(UpdateAppointmentNoteRequest $request, AppointmentNote $appointmentNote): AppointmentResource
    {
        $appointmentNote->update($request->validated());

        return new AppointmentNoteResource($appointmentNote->load(AppointmentNote::DEFAULT_RELATIONS));
    }

    public function destroy(AppointmentNote $appointmentNote): Response
    {
        $appointmentNote->delete();

        return response()->noContent();
    }
}
