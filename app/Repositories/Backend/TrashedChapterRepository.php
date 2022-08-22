<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\TrashedChapterRepositoryInterface;
use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Support\Collection;

final class TrashedChapterRepository implements TrashedChapterRepositoryInterface
{
    public function getTrashes($course): array|Collection
    {
        return [
            Chapter::onlyTrashed()
                ->orderByDesc('created_at', 'desc')
                ->get(),
            self::getCourse(course: $course),
        ];
    }

    public function restore($course, string $key, $alert): mixed
    {
        $chapter = $this->getTrashedChapter(key: $key);
        $chapter->restore();
        $alert->addSuccess('Le chapitre a ete restorer avec success');

        return self::getCourse(course: $course);
    }

    public function deleted($course, string $key, $alert): mixed
    {
        $chapter = $this->getTrashedChapter(key: $key);
        $chapter->forceDelete();
        $alert->addInfo('chapitre supprimer definivement avec succes');

        return self::getCourse(course: $course);
    }

    private function getTrashedChapter(string $key): mixed
    {
        return Chapter::withTrashed()
            ->when('key', function ($query) use ($key) {
                $query->where('key', $key);
            })
            ->first();
    }

    protected static function getCourse($course)
    {
        return Course::query()
            ->when('key', function ($query) use ($course) {
                $query->where('key', $course);
            })
            ->first();
    }
}
