<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\ChapterRepositoryInterface;
use App\Contracts\CourseRepositoryInterface;
use App\Contracts\LessonRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
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
    ) {
    }

    public function index(): Renderable
    {
        $lessons = $this->repository->getLessons();

        return view('backend.domain.academic.lessons.index', compact('lessons'));
    }

    public function show(string $key): Factory|View|Application
    {
        $chapter = $this->repository->showLesson(key:  $key);

        return view('backend.domain.academic.lessons.show');
    }

    public function create(): Renderable
    {
        $chapters = [];

        return view('backend.domain.academic.lessons.create', compact('chapters'));
    }

    public function store(LessonRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes, flash: $this->factory);

        return to_route('admins.academic.lessons.index');
    }

    public function edit(string $key): HttpResponse
    {
        $lesson = $this->repository->showLesson(key:  $key);

        return Response::view('backend.domain.academic.lessons.edit', compact('lesson'));
    }

    public function update(string $key, LessonRequest $attributes): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes, flash: $this->factory);

        return to_route('admins.academic.lessons.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key, flash: $this->factory);

        return back();
    }
}
