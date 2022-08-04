<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\CourseRepositoryInterface;
use App\Enums\StatusEnum;
use App\Models\Course;
use App\Services\ToastMessageService;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use LaravelIdea\Helper\App\Models\_IH_Course_QB;

class CourseRepository implements CourseRepositoryInterface
{
    use ImageUploader;

    public function __construct(protected ToastMessageService $service)
    {
    }

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
                    'weighting',
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
                'weighting',
            ])
            ->with(['category:id,name', 'professors:id,username,email'])
            ->where('institution_id', '=', auth()->user()->institution->id)
            ->withCount('chapters')
            ->orderByDesc('created_at')
            ->get();
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
                'weighting',
                'description',
                'institution_id',
            ])
            ->where('id', '=', $key)
            ->first();

        return $course->load(['category:id,name', 'professors:id,username,lastname,email', 'chapters', 'institution']);
    }

    public function stored($attributes): Model|Builder|Course
    {
        $course = Course::query()
            ->create([
                'name' => $attributes->input('name'),
                'weighting' => $attributes->input('weighting'),
                'category_id' => $attributes->input('category'),
                'professor_id' => $attributes->input('professor'),
                'description' => $attributes->input('description'),
                'images' => self::uploadFiles($attributes),
                'status' => StatusEnum::TRUE,
                'institution_id' => $attributes->input('institution') ?? \Auth::user()->institution->id,
            ]);

        $course->professors()->sync($attributes->input('professor'));
        $this->service->success('Un nouveau cours a ete ajouter');

        return $course;
    }

    public function updated(string $key, $attributes): _IH_Course_QB|Model|Builder|Course|null
    {
        $course = $this->showCourse(key: $key);
        $this->removePathOfImages($course);
        $course->professors()->detach();
        $course->update([
            'name' => $attributes->input('name'),
            'weighting' => $attributes->input('weighting'),
            'category_id' => $attributes->input('category'),
            'professor_id' => $attributes->input('professor'),
            'description' => $attributes->input('description'),
            'images' => self::uploadFiles($attributes),
        ]);
        $course->professors()->sync($attributes->input('professor'));
        $this->service->success('Un nouveau cours a ete ajouter');

        return $course;
    }

    public function deleted(string $key): RedirectResponse
    {
        $professor = $this->showCourse(key: $key);
        if ($professor->status !== StatusEnum::FALSE) {
            $this->service->error('Veillez desactiver le cours avant de le mettre dans la corbeille');

            return back();
        }
        $professor->delete();
        $this->service->success('Une modification a ete effectuer sur ce cours');

        return back();
    }

    public function changeStatus($attributes): bool|int
    {
        $professor = $this->showCourse(key: $attributes->input('key'));
        if ($professor != null) {
            return $professor->update([
                'status' => $attributes->input('status'),
            ]);
        }

        return false;
    }
}
