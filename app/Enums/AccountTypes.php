<?php

namespace App\Enums;

enum AccountTypes: string
{
    case DOCTOR = "doctor";
    case PATIENT = "patient";
    case RECEPTIONIST = "receptionist";
    case USER = "user";
}