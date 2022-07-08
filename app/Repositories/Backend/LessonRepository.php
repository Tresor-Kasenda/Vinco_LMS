<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\LessonRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use LaravelIdea\Helper\App\Models\_IH_Lesson_QB;

class LessonRepository implements LessonRepositoryInterface
{
    public function getLessons(): array|Collection
    {
        return Lesson::query()
            ->select([
                'id',
                'name',
                'chapter_id',
                'lesson_type_id'
            ])
            ->with(['chapter:id,name,course_id', 'chapter.course:id,name', 'type:id,name'])
            ->orderByDesc('created_at')
            ->get();
    }

    public function showLesson(string $key): Model|_IH_Lesson_QB|Lesson|Builder|null
    {
        $lesson = Lesson::query()
            ->select([
                'id',
                'name',
                'chapter_id',
                'content',
                'lesson_type_id'
            ])
            ->where('id', '=', $key)
            ->first();

        return $lesson->load([
            'type:id,name',
            'chapter:id,name,course_id',
            'chapter.course:id,name,professor_id,images',
            'chapter.course.professors:id,username,email'
        ]);
    }

    public function stored($attributes, $flash): Lesson|Builder|Model|RedirectResponse
    {
        $lesson = Lesson::query()
            ->create([
                'chapter_id' => $attributes->input('chapter'),
                'name' => $attributes->input('name'),
                'content' => $attributes->input('content'),
                'lesson_type_id' => $attributes->input('type')
            ]);
        $flash->addSuccess('Une nouvelle lecon a ete ajouter');

        return $lesson;
    }

    public function updated(string $key, $attributes, $flash): Model|_IH_Lesson_QB|Lesson|Builder|null
    {
        $lesson = $this->showLesson(key: $key);
        $lesson->update([
            'chapter_id' => $attributes->input('chapter'),
            'name' => $attributes->input('name'),
            'content' => $attributes->input('content'),
            'lesson_type_id' => $attributes->input('type')
        ]);
        $flash->addSuccess('Une lecon a ete mise a jours avec success');

        return $lesson;
    }

    public function deleted(string $key, $flash): Lesson|Builder|Model|_IH_Lesson_QB
    {
        $lesson = $this->showLesson(key: $key);
        $lesson->delete();
        $flash->addSuccess('La lesson a ete supprimer avec success');
        return $lesson;
    }
}
