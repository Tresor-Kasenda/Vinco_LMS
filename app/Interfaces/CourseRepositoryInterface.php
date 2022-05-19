<?php

namespace App\Interfaces;

interface CourseRepositoryInterface
{
    public function getCourses();

    public function showCourse(string $key);

    public function stored($attributes, $flash);

    public function updated(string $key, $attributes, $flash);

    public function deleted(string $key, $flash);

    public function changeStatus($attributes);
}
