<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\ProfessorRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfirmerProfessorRequest;
use App\Http\Requests\ProfessorRequest;
use App\Http\Requests\ProfessorUpdateRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

final class ProfessorBackendController extends Controller
{
    public function __construct(
        protected readonly ProfessorRepositoryInterface $repository,
    ) {
    }

    public function index(): Renderable
    {
        $teachers = $this->repository->getProfessors();

        return view('backend.domain.users.teacher.index', compact('teachers'));
    }

    public function create(): Renderable
    {
        return view('backend.domain.users.teacher.create');
    }

    public function store(ProfessorRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes);

        return to_route('admins.users.teacher.index');
    }

    public function show(string $key): Factory|View|Application
    {
        $teacher = $this->repository->showProfessor(key: $key);

        return view('backend.domain.users.teacher.show', compact('teacher'));
    }

    public function edit(string $key): Factory|View|Application
    {
        $teacher = $this->repository->showProfessor(key: $key);

        return view('backend.domain.users.teacher.edit', compact('teacher'));
    }

    public function update(ProfessorUpdateRequest $attributes, string $key): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes);

        return to_route('admins.users.teacher.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key);

        return back();
    }

    public function activate(ConfirmerProfessorRequest $request): JsonResponse
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
