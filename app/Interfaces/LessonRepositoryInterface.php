<?php

declare(strict_types=1);

namespace App\Interfaces;

interface LessonRepositoryInterface
{
    public function getLessons($course, $chapter);

    public function showLesson($course, $chapter, string $key);

    public function getChapterAndCourse($course, $chapter);

    public function stored($attributes, $chapter, $course, $flash);

    public function updated($course, $chapter, string $key, $attributes, $flash);

    public function deleted($course, $chapter, string $key, $flash);
}
