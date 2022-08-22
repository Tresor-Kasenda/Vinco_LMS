<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\LessonRepositoryInterface;
use App\Factory\LessonFactory;
use App\Models\Lesson;
use App\Models\LessonType;
use App\Services\ToastMessageService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Builder;
use Illuminate\Http\RedirectResponse;

final class LessonRepository implements LessonRepositoryInterface
{
    public function __construct(
        protected ToastMessageService $service,
        protected LessonFactory $lessonFactory
    )
    {
    }

    public function getLessons(): array|Collection
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return Lesson::query()
                ->select([
                    'id',
                    'name',
                    'chapter_id',
                ])
                ->with([
                    'chapter:id,name,course_id',
                    'chapter.course:id,name',
                    'type:id,name',
                ])
                ->orderByDesc('created_at')
                ->get();
        }

        return Lesson::query()
            ->select([
                'id',
                'name',
                'chapter_id',
            ])
            ->whereHas('chapter', function ($builder) {
                $builder->whereHas('course', function ($builder) {
                    $builder->where('institution_id', auth()->user()->institution->id);
                });
            })
            ->with([
                'chapter:id,name,course_id',
                'chapter.course:id,name',
                'type:id,name',
            ])
            ->orderByDesc('created_at')
            ->get();
    }

    /**
     * @throws \Exception
     */
    public function stored($attributes): Lesson|Builder|Model|RedirectResponse
    {
        $type = $this->getLessonType($attributes);

        $lesson = $this->storeLesson($attributes);

        if (\App\Enums\LessonType::TYPE_TEXT !== $lesson->id) {
            $lessonType = $this->lessonFactory->storageLessonType(type: $type->id);
            $lessonType->store(attributes: $attributes, lesson: $lesson->id);
        }
        $this->service->success('Une nouvelle lecon a ete ajouter');

        return $lesson;
    }

    public function getLessonType($attributes): LessonType|Builder|Model
    {
        return LessonType::query()
            ->select([
                'id',
                'name',
            ])
            ->where('id', '=', $attributes->input('type'))
            ->firstOrFail();
    }

    public function storeLesson($attributes): Lesson|Builder|Model
    {
        return Lesson::query()
            ->create([
                'chapter_id' => $attributes->input('chapter'),
                'name' => $attributes->input('name'),
                'content' => $attributes->input('content'),
                'lesson_type_id' => $attributes->input('type'),
            ]);
    }

    public function updated(string $key, $attributes): Model|Lesson|Builder|null
    {
        $lesson = $this->showLesson(key: $key);
        $lesson->update([
            'chapter_id' => $attributes->input('chapter'),
            'name' => $attributes->input('name'),
            'content' => $attributes->input('content'),
            'lesson_type_id' => $attributes->input('type'),
        ]);
        $this->service->success('Une lecon a ete mise a jours avec success');

        return $lesson;
    }

    public function showLesson(string $key): Model|Lesson|Builder|null
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
            'chapter.course.professors:id,username,email',
            'resources:id,name,path',
        ]);
    }

    public function deleted(string $key): Lesson|Builder|Model
    {
        $lesson = $this->showLesson(key: $key);
        $lesson->delete();
        $this->service->success('La lesson a ete supprimer avec success');

        return $lesson;
    }
}
