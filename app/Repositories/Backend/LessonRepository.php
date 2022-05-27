<?php
declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Enums\StatusEnum;
use App\Interfaces\LessonRepositoryInterface;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;

class LessonRepository implements LessonRepositoryInterface
{
    public function getLessons($course, $chapter): array|Collection
    {
        return Lesson::query()
            ->with('chapter')
            ->orderByDesc('created_at')
            ->get();
    }

    public function showLesson($course, $chapter, string $key): array
    {
        $lesson = Lesson::query()
            ->when('key', fn($query) => $query->where('key', $key))
            ->first();
        return [
            $lesson->load('chapter'),
            self::getCourse(course: $course),
            self::getChapter(chapter: $chapter)
        ];
    }

    public function getChapterAndCourse($course, $chapter): array
    {
        return [
            self::getCourse(course: $course),
            self::getChapter(chapter: $chapter)
        ];
    }

    public function stored($attributes, $chapter, $course, $flash): array|RedirectResponse
    {
        $lesson = Lesson::query()
            ->when('name', function ($query) use ($attributes) {
                $query->where('name', $attributes->input('name'));
            })
            ->first();
        if (! $lesson) {
            [$courses, $chapters] = $this->getChapterAndCourse(course: $course, chapter: $chapter);
            $lesson = Lesson::query()
                ->create([
                    'chapter_id' => $chapters->id,
                    'status' => StatusEnum::TRUE,
                    'name' => $attributes->input('name'),
                    'shortContent' => $attributes->input('shortContent'),
                    'content' => $attributes->input('content'),
                ]);
            $flash->addSuccess('Une nouvelle lecon a ete ajouter');

            return [$lesson, $courses, $chapters];
        }
        $flash->addError('Nom du lecon existe deja pour ce chapitre');

        return back();
    }

    public function updated($course, $chapter, string $key, $attributes, $flash): array
    {
        [$lesson, $courses, $chapters] = $this->showLesson(course: $course, chapter: $chapter, key: $key);
        $lesson->update([
            'chapter_id' => $chapters->id,
            'name' => $attributes->input('name'),
            'shortContent' => $attributes->input('shortContent'),
            'content' => $attributes->input('content'),
        ]);
        $flash->addSuccess('Une lecon a ete mise a jours avec success');

        return [$lesson, $courses, $chapters];
    }

    public function deleted($course, $chapter, string $key, $flash): array
    {
        [$lesson, $courses, $chapters] = $this->showLesson(course: $course, chapter: $chapter, key: $key);
        $lesson->delete();
        $flash->addSuccess('La lesson a ete supprimer avec success');

        return [$courses, $chapters];
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
}
