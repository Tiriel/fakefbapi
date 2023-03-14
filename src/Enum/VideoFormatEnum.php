<?php

namespace App\Enum;

enum VideoFormatEnum: string
{
    case STANDARD = '4:3';
    case HIGH_DEF = '16:9';
    case ANAMORPHIC = '2.40:1';
}
