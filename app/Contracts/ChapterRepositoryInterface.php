<?php

declare(strict_types=1);

namespace App\Contracts;

interface ChapterRepositoryInterface
{
    public function getChapters();

    public function showChapter(string $key);

    public function stored($attributes);

    public function updated(string $key, $attributes);

    public function deleted(string $key);
}
