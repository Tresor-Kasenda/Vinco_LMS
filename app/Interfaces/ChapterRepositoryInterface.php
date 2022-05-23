<?php
declare(strict_types=1);

namespace App\Interfaces;

use App\Models\Course;

interface ChapterRepositoryInterface
{
    public function getChapters(Course $course);

    public function showChapter(string $key);

    public function stored($attributes, $flash);

    public function updated(string $key, $attributes, $flash);

    public function deleted(string $key, $flash);

    public function changeStatus($attributes);
}
