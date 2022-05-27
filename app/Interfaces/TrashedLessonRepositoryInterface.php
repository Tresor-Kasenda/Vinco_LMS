<?php
declare(strict_types=1);

namespace App\Interfaces;

interface TrashedLessonRepositoryInterface
{
    public function getTrashes($course, $chapter);

    public function restore($course, $chapter, string $key, $alert);

    public function deleted($course, $chapter, string $key, $alert);
}
