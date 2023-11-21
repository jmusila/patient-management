<?php

namespace App\Enums;

enum Statuses: string
{
    case ACTIVE = "Active";
    case DORMANT = "Dormant";
    case INACTIVE = "Inactive";
}