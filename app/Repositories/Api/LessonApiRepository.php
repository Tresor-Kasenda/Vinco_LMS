<?php

declare(strict_types=1);

namespace App\Repositories\Api;

use App\Http\Requests\LessonApiRequest;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Collection;

final class LessonApiRepository
{
    public function getLessons(LessonApiRequest $apiRequest): Collection|array
    {
        return Lesson::query()
            ->select([
                'id',
                'name',
                'chapter_id',
            ])
            ->where('chapter_id', '=', $apiRequest->input('chapter'))
            ->get();
    }
}
