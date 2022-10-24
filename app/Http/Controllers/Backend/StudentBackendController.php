<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\StudentRepositoryInterface;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Services\ToastMessageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class StudentBackendController extends BackendBaseController
{
    public function __construct(
        public ToastMessageService $factory,
        protected readonly StudentRepositoryInterface $repository
    ) {
        parent::__construct($this->factory);
    }

    public function index(): Renderable
    {
        $students = $this->repository->students();

        return view('backend.domain.users.student.index', compact('students'));
    }

    public function create(): Renderable
    {
        return view('backend.domain.users.student.create');
    }

    public function store(StudentRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes);

        return to_route('admins.users.student.index');
    }

    public function show(string $key): Factory|View|Application
    {
        $student = $this->repository->showStudent($key);

        return view('backend.domain.users.student.show', compact('student'));
    }

    public function edit(string $key): Factory|View|Application
    {
        $student = $this->repository->showStudent($key);

        return view('backend.domain.users.student.edit', compact('student'));
    }

    public function update(StudentUpdateRequest $attributes, string $key): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes);

        return to_route('admins.users.student.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key);

        return to_route('admins.users.student.index');
    }
}
