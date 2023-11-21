<?php

use App\Enums\Roles;

return [
    Roles::ADMIN => [
        "view_patient_information",
        "create_patient",
        "update_patient_information",
        "delete_patient_information",
        "book_an_appointment_for_a_patient",
        "confirm_patient",
    ],
    Roles::DOCTOR => [
        "view_own_appointments",
        "view_patient_details",
        "record_appointment_notes",
        "update_appointment_notes",
        "record_appointment_prescription",
    ],
    Roles::RECEPTIONIST => [
        "view_patient_information",
        "create_patient",
        "update_patient_information",
        "delete_patient_information",
        "book_an_appointment_for_a_patient",
        "confirm_patient",
    ]
];