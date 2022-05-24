<?php
declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Enums\StatusEnum;
use App\Interfaces\ChapterRepositoryInterface;
use App\Models\Chapter;
use App\Models\Course;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\HigherOrderWhenProxy;

class ChapterRepository implements ChapterRepositoryInterface
{
    use ImageUploader;

    public function getChapters(Course $course): array|Collection
    {
        return Chapter::query()
            ->whereBelongsTo($course)
            ->withCount(['lessons', 'exercises'])
            ->orderByDesc('created_at')
            ->get();
    }

    public function showChapter($course, string $key): Model|Builder|Chapter|null|array
    {
        $chapter = Chapter::query()
            ->where('key', '=', $key)
            ->first();
        return [
            $chapter->load('lessons'),
            self::getCourse(course: $course)
        ];
    }

    public function stored($attributes, $flash): Model|Builder|Chapter|RedirectResponse|array
    {
        $chapter = Chapter::query()
            ->when('name', function ($query) use ($attributes){
                $query->where('name', $attributes->input('name'));
            })
            ->first();
        if (!$chapter){
            $course = $this->getChapter($attributes);
            $chapter = Chapter::query()
                ->create([
                    'course_id' => $course->id,
                    'status' => StatusEnum::TRUE,
                    'name' => $attributes->input('name'),
                    'displayType' => $attributes->input('displayType'),
                    'description' => $attributes->input('description')
                ]);
            $flash->addSuccess("Un nouveau cours a ete ajouter");
            return [$chapter, $course];
        }
        $flash->addError("Nom du cours ou le professeur a existe deja pour ce cours");
        return back();
    }

    public function updated($course, string $key, $attributes, $flash): array
    {
        [$chapter, $courses] = $this->showChapter(course: $course, key: $key);
        $course = $this->getChapter($attributes);
        $chapter->update([
            'course_id' => $course->id,
            'name' => $attributes->input('name'),
            'displayType' => $attributes->input('displayType'),
            'description' => $attributes->input('description')
        ]);
        $flash->addSuccess("Un cours a ete mise a jours avec success");
        return [$chapter, $courses];
    }

    public function deleted($course, string $key, $flash)
    {
        [$chapter, $courses] = $this->showChapter(course: $course, key: $key);
        $chapter->delete();
        $flash->addSuccess('Le chapitre a ete supprimer avec success');
        return $courses;
    }

    /**
     * @param $attributes
     * @return Course|Builder|Model|HigherOrderWhenProxy|mixed|object|null
     */
    private function getChapter($attributes): mixed
    {
        return Course::query()
            ->when('name', function ($query) use ($attributes) {
                $query->where('name', $attributes->input('course'));
            })
            ->first();
    }

    protected static function getCourse($course)
    {
        return Course::query()
            ->when('key', function ($query) use ($course){
                $query->where('key', $course);
            })
            ->first();
    }
}
