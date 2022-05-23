<?php
declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChapterRequest;
use App\Http\Requests\StatusCourseRequest;
use App\Interfaces\ChapterRepositoryInterface;
use App\Interfaces\CourseRepositoryInterface;
use App\Models\Course;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

class ChapterBackendController extends Controller
{
    public function __construct(
        public ChapterRepositoryInterface $repository,
        public SweetAlertFactory $factory,
        public CourseRepositoryInterface $courseRepository
    ){}

    public function show(string $key): Factory|View|Application
    {
        return view('backend.domain.cours.show', [
            'chapter' => $this->repository->showChapter(key:  $key)
        ]);
    }

    public function create(string $course): Renderable
    {
        return view('backend.domain.cours.chapters.create', [
            'course' => $this->courseRepository->showCourse(key: $course)
        ]);
    }

    public function store(ChapterRequest $attributes): RedirectResponse
    {
        $chapter = $this->repository->stored(attributes: $attributes, flash: $this->factory);
        return to_route('admins.course.show', ['course' => $chapter[1]->key]);
    }

    public function edit(Course $course, string $key): HttpResponse
    {
        return Response::view('backend.domain.cours.edit', [
            'chapter' => $this->repository->showChapter(key: $key),
            'course' => $course
        ]);
    }

    public function update(string $key, ChapterRequest $attributes): RedirectResponse
    {
        $chapter = $this->repository->updated(key: $key, attributes: $attributes, flash: $this->factory);
        return to_route('admins.course.show', ['course' => $chapter[1]->key]);
    }

    public function destroy(string $key): RedirectResponse
    {
        $chapter = $this->repository->deleted(key: $key, flash: $this->factory);
        return back();
    }

    public function activate(StatusCourseRequest $request): JsonResponse
    {
        $employee = $this->repository->changeStatus(attributes: $request);
        if ($employee){
            return response()->json([
                'message' => "The status has been successfully updated"
            ]);
        }
        return response()->json([
            'message' => "Desoler"
        ]);
    }
}
