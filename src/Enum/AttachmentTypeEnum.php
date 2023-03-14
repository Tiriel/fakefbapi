<?php

namespace App\Enum;

enum AttachmentTypeEnum: string
{
    case PHOTO = 'photo';
    case VIDEO = 'video';
    case EVENT = 'event';
}
