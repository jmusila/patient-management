<?php

namespace App\Enums;

enum ApprovalStatuses: string
{
    case APPROVED = "Approved";
    case PENDING_APPROVAL = "Pending Approval";
    case DECLINED = "Declined";
}