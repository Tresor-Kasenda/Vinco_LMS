<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Course;

interface ChapterRepositoryInterface
{
    public function getChapters(Course $course);

    public function showChapter($course, string $key);

    public function stored($attributes, $flash);

    public function updated($course, string $key, $attributes, $flash);

    public function deleted($course, string $key, $flash);
}
