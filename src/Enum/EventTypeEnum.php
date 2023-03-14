<?php

namespace App\Enum;

enum EventTypeEnum: string
{
    case PRIVATE = 'private';
    case PUBLIC = 'public';
    case GROUP = 'group';
    case COMMUNITY = 'community';
    case FRIENDS = 'friends';
    case WORK_COMPANY = 'work_company';
}
