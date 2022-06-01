<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\TrashedLessonRepositoryInterface;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;

class TrashedLessonRepository implements TrashedLessonRepositoryInterface
{
    public function getTrashes(): array
    {
        return Lesson::onlyTrashed()
                ->orderByDesc('created_at', 'desc')
                ->get();
    }

    public function restore(string $key, $alert): array
    {
        $lesson = $this->getTrashedLesson(key: $key);
        $lesson->restore();
        $alert->addSuccess('La lecon a ete restorer avec success');

        return $lesson;
    }

    public function deleted(string $key, $alert): array
    {
        $lesson = $this->getTrashedLesson(key: $key);

        $lesson->forceDelete();
        $alert->addInfo('La lecon a ete  supprimer definivement avec succes');

        return $lesson;
    }

    private function getTrashedLesson(string $key)
    {
        return Lesson::withTrashed()
            ->when('key', function ($query) use ($key) {
                $query->where('key', $key);
            })
            ->first();
    }
}
