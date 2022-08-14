<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Http\Requests\LessonRequest;
use App\Http\Requests\LessonUpdateRequest;

interface LessonTypeInterface
{
    public function store(LessonRequest $attributes, $lesson);

    public function update(LessonUpdateRequest $request, $lesson);
}
