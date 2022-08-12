<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Http\Requests\LessonRequest;

interface LessonTypeInterface
{
    public function store(LessonRequest $attributes, $lesson);
}
