<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\HomeworkRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\Homework;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use LaravelIdea\Helper\App\Models\_IH_Homework_QB;

class HomeworkRepository implements HomeworkRepositoryInterface
{
    public function homeworks(): array|Collection
    {
        return Homework::query()
            ->select([
                'id',
                'name',
                'rating_homework',
                'filling_date',
                'lesson_id',
                'course_id',
                'chapter_id'
            ])
            ->with([
                'chapter:id,name',
                'course:id,name,images',
                'lesson:id,name'
            ])
            ->orderByDesc('created_at')
            ->get();
    }

    public function showHomework(string $key): Model|Builder|Homework|_IH_Homework_QB|null
    {
        $homework = Homework::query()
            ->select([
                'id',
                'name',
                'rating_homework',
                'filling_date',
                'lesson_id',
                'course_id',
                'chapter_id',
                'status'
            ])
            ->where('id', '=', $key)
            ->first();

        return $homework->load([
            'chapter:id,name',
            'course:id,name,images',
            'lesson:id,name'
        ]);
    }

    public function stored($attributes, $factory): Model|Builder|Homework|_IH_Homework_QB
    {
        $homework = Homework::query()
            ->create([
                'name' => $attributes->input('name'),
                'rating_homework' => $attributes->input('rating'),
                'filling_date' => $attributes->input('date'),
                'status' => StatusEnum::FALSE,
                'course_id' => $attributes->input('course'),
                'chapter_id' => $attributes->input('chapter'),
                'lesson_id' => $attributes->input('lesson')
            ]);

        $factory->addSuccess('Un TP a ete ajouter');

        return $homework;
    }

    public function updated(string $key, $attributes, $factory): Model|Builder|Homework|_IH_Homework_QB|null
    {
        $homework = $this->showHomework($key);
        $homework->update([
            'name' => $attributes->input('name'),
            'rating_homework' => $attributes->input('rating'),
            'filling_date' => $attributes->input('date'),
            'course_id' => $attributes->input('course'),
            'chapter_id' => $attributes->input('chapter'),
            'lesson_id' => $attributes->input('lesson')
        ]);

        $factory->addSuccess('Un TP a ete modifier');

        return $homework;
    }

    public function deleted(string $key, $factory): Builder|Homework|\Illuminate\Database\Query\Builder|null
    {
        $homework = $this->showHomework($key);
        $homework->delete();
        $factory->addSuccess('Un TP a ete supprimer avec succes');
        return $homework;
    }
}
