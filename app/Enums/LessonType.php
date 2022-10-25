<?php

declare(strict_types=1);

namespace App\Enums;

enum LessonType: int
{
case TYPE_VIDEO = 1;
case TYPE_APERI = 2;
case TYPE_TEXT = 3;
case TYPE_PDF = 4;
    }
