<?php

namespace App\Enum;

enum PostTypeEnum: string
{
    case STATUS = 'status';
    case PHOTO = 'photo';
    case VIDEO = 'video';
    case EVENT = 'event';
}
