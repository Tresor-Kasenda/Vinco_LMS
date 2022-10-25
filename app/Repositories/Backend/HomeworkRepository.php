<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\HomeworkRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\Homework;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class HomeworkRepository implements HomeworkRepositoryInterface
{

    public function homeworks(): array|Collection
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return Homework::query()
                ->select([
                    'id',
                    'name',
                    'rating_homework',
                    'filling_date',
                    'lesson_id',
                    'course_id',
                    'chapter_id',
                ])
                ->with([
                    'chapter:id,name',
                    'course:id,name,images',
                    'lesson:id,name',
                ])
                ->orderByDesc('created_at')
                ->get();
        }

        return Homework::query()
            ->select([
                'id',
                'name',
                'rating_homework',
                'filling_date',
                'lesson_id',
                'course_id',
                'chapter_id',
            ])
            ->whereHas('course', function ($query) {
                $query->where('institution_id', auth()->user()->institution->id);
            })
            ->with([
                'chapter:id,name',
                'course:id,name,images',
                'lesson:id,name',
            ])
            ->orderByDesc('created_at')
            ->get();
    }

    public function stored($attributes): Model|Builder|Homework
    {
        return Homework::query()
            ->create([
                'name' => $attributes->input('name'),
                'rating_homework' => $attributes->input('rating'),
                'filling_date' => $attributes->input('date'),
                'status' => StatusEnum::FALSE,
                'course_id' => $attributes->input('course'),
                'chapter_id' => $attributes->input('chapter'),
                'lesson_id' => $attributes->input('lesson'),
            ]);
    }

    public function updated(string $key, $attributes): Model|Builder|Homework|null
    {
        $homework = $this->showHomework($key);
        $homework->update([
            'name' => $attributes->input('name'),
            'rating_homework' => $attributes->input('rating'),
            'filling_date' => $attributes->input('date'),
            'course_id' => $attributes->input('course'),
            'chapter_id' => $attributes->input('chapter'),
            'lesson_id' => $attributes->input('lesson'),
        ]);

        return $homework;
    }

    public function showHomework(string $key): Model|Builder|Homework|null
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
                'status',
            ])
            ->where('id', '=', $key)
            ->first();

        return $homework->load([
            'chapter:id,name',
            'course:id,name,images',
            'lesson:id,name',
        ]);
    }

    public function deleted(string $key): Builder|Homework|\Illuminate\Database\Query\Builder|null
    {
        $homework = $this->showHomework($key);
        $homework->delete();

        return $homework;
    }
}
