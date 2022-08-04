<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\LessonRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use App\Http\Requests\LessonUpdateRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View;

class LessonBackendController extends Controller
{
    public function __construct(
        protected readonly LessonRepositoryInterface $repository,
    ) {
    }

    public function index(): Renderable
    {
        $lessons = $this->repository->getLessons();

        return view('backend.domain.academic.lessons.index', compact('lessons'));
    }

    public function create(): Renderable
    {
        return view('backend.domain.academic.lessons.create');
    }

    public function store(LessonRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes);

        return to_route('admins.academic.lessons.index');
    }

    public function show(string $key): Factory|View|Application
    {
        $lesson = $this->repository->showLesson(key:  $key);

        return view('backend.domain.academic.lessons.show', compact('lesson'));
    }

    public function edit(string $key): Factory|View|Application
    {
        $lesson = $this->repository->showLesson(key:  $key);

        return view('backend.domain.academic.lessons.edit')->with('lesson', $lesson);
    }

    public function update(string $key, LessonUpdateRequest $attributes): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes);

        return to_route('admins.academic.lessons.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key);

        return back();
    }
}
