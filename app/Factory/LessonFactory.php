<?php

declare(strict_types=1);

namespace App\Factory;

use App\Repositories\OpenClose\AperyLessonType;
use App\Repositories\OpenClose\PdfLessonType;
use App\Repositories\OpenClose\VideoLessonType;
use Exception;

final class LessonFactory
{
    /**
     * @throws Exception
     */
    public function storageLessonType($type): VideoLessonType|AperyLessonType|string|PdfLessonType
    {
        return match ($type) {
            1 => new VideoLessonType(),
            2 => new AperyLessonType(),
            4 => new PdfLessonType(),
            default => throw new Exception("'unknown status code'"),
        };
    }
}
