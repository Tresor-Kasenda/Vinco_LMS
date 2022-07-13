<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\CourseRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\StatusCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

class CourseBackendController extends Controller
{
    public function __construct(
        private readonly CourseRepositoryInterface $repository,
        private readonly SweetAlertFactory $factory,
    ) {
    }

    public function index(): Renderable
    {
        $courses = $this->repository->getCourses();

        return view('backend.domain.academic.cours.index', compact('courses'));
    }

    public function create(): Renderable
    {
        return view('backend.domain.academic.cours.create');
    }

    public function store(CourseRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes, flash: $this->factory);

        return to_route('admins.academic.course.index');
    }

    public function show(string $key): Factory|View|Application
    {
        $course = $this->repository->showCourse(key:  $key);

        return view('backend.domain.academic.cours.show', compact('course'));
    }

    public function edit(string $key): HttpResponse
    {
        $course = $this->repository->showCourse($key);

        return Response::view('backend.domain.academic.cours.edit', compact('course'));
    }

    public function update(string $key, UpdateCourseRequest $attributes): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes, flash: $this->factory);

        return Response::redirectToRoute('admins.academic.course.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key, flash: $this->factory);

        return Response::redirectToRoute('admins.academic.course.index');
    }

    public function activate(StatusCourseRequest $request): JsonResponse
    {
        $employee = $this->repository->changeStatus(attributes: $request);
        if ($employee) {
            return response()->json([
                'message' => 'The status has been successfully updated',
            ]);
        }

        return response()->json([
            'message' => 'Desoler',
        ]);
    }
}
