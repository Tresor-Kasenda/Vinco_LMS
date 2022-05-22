<?php
declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Enums\StatusEnum;
use App\Interfaces\CourseRepositoryInterface;
use App\Models\Course;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use function PHPUnit\Framework\assertTrue;

class CourseRepository implements CourseRepositoryInterface
{
    use ImageUploader;

    public function getCourses(): array|Collection
    {
        return Course::query()
            ->with(['category', 'user'])
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
        return $course->load(['category', 'user']);
    }

    public function stored($attributes, $flash): Model|Builder|Course|RedirectResponse
    {
        $course = Course::query()
            ->where('name', '=', $attributes->input('name'))
            ->first();

        if (!$course) {
            $course = Course::query()
                ->create([
                    'category_id' => $attributes->input('category'),
                    'user_id' => $attributes->input('professor'),
                    'name' => $attributes->input('name'),
                    'subDescription' => $attributes->input('subDescription'),
                    'description' => $attributes->input('description'),
                    'images' => self::uploadFiles($attributes),
                    'startDate' => $attributes->input('startDate'),
                    'endDate' => $attributes->input('endDate'),
                    'duration' => $attributes->input('duration'),
                    'status' => StatusEnum::FALSE,
                ]);
            $flash->addSuccess("Un nouveau cours a ete ajouter");
            return $course;
        }
        $flash->addError("Nom du cours ou le professeur a existe deja pour ce cours");
        return back();

    }

    public function updated(string $key, $attributes, $flash)
    {
        $course = $this->showCourse(key: $key);
        $this->removePathOfImages($course);
        $course->update([
            'category_id' => $attributes->input('category'),
            'user_id' => $attributes->input('professor'),
            'name' => $attributes->input('name'),
            'subDescription' => $attributes->input('subDescription'),
            'description' => $attributes->input('description'),
            'images' => self::uploadFiles($attributes),
            'startDate' => $attributes->input('startDate'),
            'endDate' => $attributes->input('endDate'),
            'duration' => $attributes->input('duration'),
        ]);
        $flash->addSuccess("Un nouveau cours a ete ajouter");
        return $course;
    }

    public function deleted(string $key, $flash): RedirectResponse
    {
        $professor = $this->showCourse(key: $key);
        if ($professor->status !== StatusEnum::FALSE){
            $flash->addError("Veillez desactiver le cours avant de le mettre dans la corbeille");
            return back();
        }
        $professor->delete();
        $flash->addSuccess('Une modification a ete effectuer sur ce cours');
        return back();
    }

    public function changeStatus($attributes): bool|int
    {
        $professor = $this->showCourse(key: $attributes->input('key'));
        if ($professor != null){
            return $professor->update([
                'status' => $attributes->input('status')
            ]);
        }
        return false;
    }
}
