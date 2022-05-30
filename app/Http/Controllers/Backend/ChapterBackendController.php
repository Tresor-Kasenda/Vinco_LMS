<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChapterRequest;
use App\Interfaces\ChapterRepositoryInterface;
use App\Interfaces\CourseRepositoryInterface;
use App\Interfaces\LessonRepositoryInterface;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

class ChapterBackendController extends Controller
{
    public function __construct(
        public ChapterRepositoryInterface $repository,
        public SweetAlertFactory $factory,
        public CourseRepositoryInterface $courseRepository,
        private readonly LessonRepositoryInterface $lessonRepository
    ) {
    }

    public function show($course, string $key): Factory|View|Application
    {
        $chapter = $this->repository->showChapter(course: $course, key:  $key);

        return view('backend.domain.cours.chapters.show', [
            'chapter' => $chapter[0],
            'course' => $chapter[1],
            'lessons' => $this->lessonRepository->getLessons(course: $chapter[0], chapter: $chapter[1]),
        ]);
    }

    public function create(string $course): Renderable
    {
        return view('backend.domain.cours.chapters.create', [
            'course' => $this->courseRepository->showCourse(key: $course),
        ]);
    }

    public function store($course, ChapterRequest $attributes): RedirectResponse
    {
        $chapter = $this->repository->stored(attributes: $attributes, flash: $this->factory);

        return to_route('admins.course.show', ['course' => $chapter[1]->key]);
    }

    public function edit($course, string $key): HttpResponse
    {
        $chapter = $this->repository->showChapter(course: $course, key:  $key);

        return Response::view('backend.domain.cours.chapters.edit', [
            'chapter' => $chapter[0],
            'course' => $chapter[1],
        ]);
    }

    public function update($course, string $key, ChapterRequest $attributes): RedirectResponse
    {
        $chapter = $this->repository->updated(course: $course, key: $key, attributes: $attributes, flash: $this->factory);

        return to_route('admins.course.show', ['course' => $chapter[1]->key]);
    }

    public function destroy($course, string $key): RedirectResponse
    {
        $chapter = $this->repository->deleted(course: $course, key: $key, flash: $this->factory);

        return to_route('admins.course.show', ['course' => $chapter->key]);
    }
}
