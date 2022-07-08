<?php

declare(strict_types=1);

namespace App\Enums;

enum LessonType: string
{
    case TEXT   = "TEXT";
    case PDF    = "PDF";
    case APERI  = "APERI";
    case VIDEO  = "VIDEO";
}
