<?php
declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Interfaces\TrashedLessonRepositoryInterface;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;

class TrashedLessonRepository implements TrashedLessonRepositoryInterface
{
    public function getTrashes($course, $chapter): array
    {
        return [
            Lesson::onlyTrashed()
                ->orderByDesc('created_at', 'desc')
                ->get(),
            self::getCourse(course: $course),
            self::getChapter(chapter: $chapter)
        ];
    }

    public function restore($course, $chapter, string $key, $alert): array
    {
        $lesson = $this->getTrashedLesson(key: $key);
        $lesson->restore();
        $alert->addSuccess('La lecon a ete restorer avec success');
        return [
            self::getCourse(course: $chapter),
            self::getChapter(chapter: $course)
        ];
    }

    public function deleted($course, $chapter, string $key, $alert): array
    {
        $lesson = $this->getTrashedLesson(key: $key);

        $lesson->forceDelete();
        $alert->addInfo('La lecon a ete  supprimer definivement avec succes');

        return [
            self::getCourse(course: $course),
            self::getChapter(chapter: $chapter)
        ];
    }

    protected static function getCourse($course)
    {
        return Course::query()
            ->when('key', function ($query) use ($course){
                $query->where('key', $course);
            })
            ->first();
    }

    protected static function getChapter($chapter)
    {
        return Chapter::query()
            ->when('key', function ($query) use ($chapter){
                $query->where('key', $chapter);
            })
            ->first();
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
