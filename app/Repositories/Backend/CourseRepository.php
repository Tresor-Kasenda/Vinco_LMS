<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\CourseRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\Course;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use LaravelIdea\Helper\App\Models\_IH_Course_QB;

final class CourseRepository implements CourseRepositoryInterface
{
    use ImageUploader;

    public function getCourses(): array|Collection
    {
        if (auth()->user()->hasRole('Super Admin')) {
            return Course::query()
                ->select([
                    'id',
                    'name',
                    'status',
                    'category_id',
                    'images',
                    'annual_rating',
                    'professor_id',
                    'institution_id',
                ])
                ->with(['category:id,name', 'professors:id,username,lastname', 'institution'])
                ->withCount('chapters')
                ->orderByDesc('created_at')
                ->get();
        }

        return Course::query()
            ->select([
                'id',
                'name',
                'status',
                'category_id',
                'images',
                'annual_rating',
            ])
            ->with(['category:id,name', 'professors:id,username,email'])
            ->where('institution_id', '=', auth()->user()->institution->id)
            ->withCount('chapters')
            ->orderByDesc('created_at')
            ->get();
    }

    public function stored($attributes): Model|Builder|Course
    {
        $course = Course::query()
            ->create([
                'name' => $attributes->input('name'),
                'annual_rating' => $attributes->input('weighting'),
                'category_id' => $attributes->input('category'),
                'professor_id' => $attributes->input('professor'),
                'description' => $attributes->input('description'),
                'images' => self::uploadFiles($attributes),
                'status' => StatusEnum::TRUE,
                'institution_id' => $attributes->input('institution') ?? \Auth::user()->institution->id,
            ]);

        $course->professors()->sync($attributes->input('professor'));

        return $course;
    }

    public function updated(string $key, $attributes): _IH_Course_QB|Model|Builder|Course|null
    {
        $course = $this->showCourse(key: $key);
        $this->removePathOfImages($course);
        $course->professors()->detach();
        $course->update([
            'name' => $attributes->input('name'),
            'annual_rating' => $attributes->input('weighting'),
            'category_id' => $attributes->input('category'),
            'professor_id' => $attributes->input('professor'),
            'description' => $attributes->input('description'),
            'images' => self::uploadFiles($attributes),
        ]);
        $course->professors()->sync($attributes->input('professor'));

        return $course;
    }

    public function showCourse(string $key): Model|_IH_Course_QB|Builder|Course|\Illuminate\Database\Query\Builder|null
    {
        $course = Course::query()
            ->select([
                'id',
                'name',
                'status',
                'description',
                'category_id',
                'images',
                'annual_rating',
                'description',
                'institution_id',
            ])
            ->where('id', '=', $key)
            ->first();

        return $course->load(['category:id,name', 'professors:id,username,lastname,email', 'chapters', 'institution']);
    }

    public function deleted(string $key): RedirectResponse
    {
        $professor = $this->showCourse(key: $key);
        if ($professor->status !== StatusEnum::FALSE) {
            return back();
        }
        $professor->delete();

        return back();
    }
}
