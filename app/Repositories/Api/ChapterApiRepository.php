<?php

declare(strict_types=1);

namespace App\Repositories\Api;

use App\Http\Requests\ChapterApiRequest;
use App\Models\Chapter;
use Illuminate\Database\Eloquent\Collection;

final class ChapterApiRepository
{
    public function getChapters(ChapterApiRequest $request): array|Collection|\Illuminate\Support\Collection
    {
        return Chapter::query()
            ->select([
                'id',
                'name',
                'course_id'
            ])
            ->where('course_id', '=', $request->input('course'))
            ->get();
    }
}
