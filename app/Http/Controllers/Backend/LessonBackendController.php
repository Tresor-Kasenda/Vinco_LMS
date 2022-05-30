<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
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

class LessonBackendController extends Controller
{
    public function __construct(
        protected readonly SweetAlertFactory $factory,
        protected readonly LessonRepositoryInterface $repository,
        protected readonly CourseRepositoryInterface $courseRepository,
        protected readonly ChapterRepositoryInterface $chapterRepository
    ) {
    }

    public function show($course, $chapter, string $key): Factory|View|Application
    {
        $chapter = $this->repository->showLesson(course: $course, chapter: $chapter, key:  $key);

        return view('backend.domain.cours.lessons.show');
    }

    public function create(string $course, $chapter): Renderable
    {
        [$courses, $chapters] = $this->repository->getChapterAndCourse(course: $course, chapter: $chapter);

        return view('backend.domain.cours.lessons.create', compact('courses', 'chapters'));
    }

    public function store($course, $chapter, LessonRequest $attributes): RedirectResponse
    {
        [$lesson, $courses, $chapters] = $this->repository->stored(
            attributes: $attributes,
            chapter: $chapter,
            course: $course,
            flash: $this->factory
        );

        return to_route('admins.course.chapter.show', ['course' => $course, 'chapter' => $chapter]);
    }

    public function edit($course, $chapter, string $key): HttpResponse
    {
        [$lesson, $courses, $chapters] = $this->repository->showLesson(course: $course, chapter: $chapter, key:  $key);

        return Response::view('backend.domain.cours.lessons.edit', [
            'chapter' => $chapters,
            'course' => $courses,
            'lesson' => $lesson,
        ]);
    }

    public function update($course, $chapter, string $key, LessonRequest $attributes): RedirectResponse
    {
        [$lesson, $courses, $chapters] = $this->repository->updated(
            course: $course,
            chapter: $chapter,
            key: $key,
            attributes: $attributes,
            flash: $this->factory
        );

        return to_route('admins.course.chapter.show', ['course' => $course, 'chapter' => $chapter]);
    }

    public function destroy($course, $chapter, string $key): RedirectResponse
    {
        $this->repository->deleted(course: $course, chapter: $chapter, key: $key, flash: $this->factory);

        return to_route('admins.course.chapter.show', ['course' => $course, 'chapter' => $chapter]);
    }
}
