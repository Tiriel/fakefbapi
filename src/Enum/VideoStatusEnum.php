<?php

namespace App\Enum;

enum VideoStatusEnum: string
{
    case READY = 'ready';
    case PROCESSING = 'processing';
    case ERROR = 'error';
}
