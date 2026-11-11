<?php

namespace App\Enums;

enum ActivityType: string
{
    case Submitted = 'submitted';
    case StatusChanged = 'status_changed';
    case DepartmentAssigned = 'department_assigned';
    case OfficerAssigned = 'officer_assigned';
    case InfoAdded = 'info_added';
    case Resolved = 'resolved';
    case Rejected = 'rejected';
}