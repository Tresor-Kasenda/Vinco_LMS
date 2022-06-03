<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\ProfessorRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfirmerProfessorRequest;
use App\Http\Requests\ProfessorRequest;
use App\Http\Requests\ProfessorUpdateRequest;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class TeacherBackendController extends Controller
{
    public function __construct(
        public ProfessorRepositoryInterface $repository,
        public SweetAlertFactory $factory
    ) {
    }

    public function index(): Renderable
    {
        return view('backend.domain.users.teacher.index', [
            'teachers' => $this->repository->getProfessors(),
        ]);
    }

    public function show(string $key): Factory|View|Application
    {
        return view('backend.domain.users.teacher.show', [
            'professor' => $this->repository->showProfessor(key:  $key),
        ]);
    }

    public function create(): Renderable
    {
        return view('backend.domain.users.teacher.create');
    }

    public function store(ProfessorRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes, factory: $this->factory);

        return to_route('admins.users.teacher.index');
    }

    public function edit(string $key): Factory|View|Application
    {
        return view('backend.domain.users.teacher.edit', [
            'professor' => $this->repository->showProfessor(key: $key),
        ]);
    }

    public function update(ProfessorUpdateRequest $attributes, string $key): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes, factory: $this->factory);

        return to_route('admins.users.teacher.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key, factory: $this->factory);

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
