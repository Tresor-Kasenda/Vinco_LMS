<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\Student;

use App\Contracts\StudentRepositoryInterface;
use App\Http\Controllers\Backend\BackendBaseController;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Services\ToastMessageService;
use App\ViewModels\Backend\Student\CreateStudentViewModel;
use App\ViewModels\Backend\Student\ShowStudentViewModel;
use App\ViewModels\Backend\Student\StudentViewModel;
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
        $viewModel = new StudentViewModel();

        return view('backend.domain.users.student.index', compact('viewModel'));
    }

    public function create(): Renderable
    {
        $viewModel = new CreateStudentViewModel();

        return view('backend.domain.users.student.create', compact('viewModel'));
    }

    public function store(StudentRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes);

        $this->factory->success(
            'success',
            'Un nouveau etudiant a ete ajouter'
        );

        return to_route('admins.users.student.index');
    }

    public function show(string $key): Factory|View|Application
    {
        $viewModel = new ShowStudentViewModel($key);

        return view('backend.domain.users.student.show', compact('viewModel'));
    }

    public function edit(string $key): Factory|View|Application
    {
        $student = $this->repository->showStudent($key);

        return view('backend.domain.users.student.edit', compact('student'));
    }

    public function update(StudentUpdateRequest $attributes, string $key): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes);

        $this->factory->success(
            'success',
            'Un etudiant a ete modifier'
        );

        return to_route('admins.users.student.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key);

        $this->factory->success(
            'success',
            'Un etudiant a ete supprimer'
        );

        return to_route('admins.users.student.index');
    }
}
