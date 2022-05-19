<?php

namespace App\Repositories\Backend;

use App\Interfaces\CourseRepositoryInterface;
use App\Models\Course;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CourseRepository implements CourseRepositoryInterface
{
    use ImageUploader;

    public function getCourses(): array|Collection
    {
        return Course::query()
            ->with('category')
            ->orderByDesc('created_at')
            ->get();
    }

    public function showCourse(string $key)
    {
        $course = Course::query()
            ->when('key', function ($query) use ($key){
                $query->where('key', $key);
            })
            ->first();
        return $course->load('category');
    }

    public function stored($attributes, $flash): Model|Builder|Course
    {
        $course = Course::query()
            ->create([

            ]);
        $flash->addSuccess("Un nouveau cours a ete ajouter");
        return $course;
    }

    public function updated(string $key, $attributes, $flash)
    {
        // TODO: Implement updated() method.
    }

    public function deleted(string $key, $flash)
    {
        // TODO: Implement deleted() method.
    }

    public function changeStatus($attributes)
    {
        // TODO: Implement changeStatus() method.
    }
}
