<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\Department;

use App\Contracts\DepartmentRepositoryInterface;
use App\Http\Controllers\Backend\BackendBaseController;
use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Services\ToastMessageService;
use App\ViewModels\Backend\Department\CreateDepartmentViewModel;
use App\ViewModels\Backend\Department\DepartmentViewModel;
use App\ViewModels\Backend\Department\EditDepartmentViewModel;
use App\ViewModels\Backend\Department\ViewDepartmentViewModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Response;

final class DepartmentBackendController extends BackendBaseController
{
    public function __construct(
        public ToastMessageService $factory,
        protected readonly DepartmentRepositoryInterface $repository
    ) {
        parent::__construct($this->factory);
    }

    public function index(): Renderable
    {
        $viewModel = new DepartmentViewModel();

        return view('backend.domain.academic.departments.index', compact('viewModel'));
    }

    public function create(): Renderable
    {
        $viewModel = new CreateDepartmentViewModel();

        return view('backend.domain.academic.departments.create', compact('viewModel'));
    }

    public function store(DepartmentRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes);

        $this->factory->success(
            "success",
            "un nouveau departement ajouter"
        );

        return to_route('admins.academic.departments.index');
    }

    public function show(string $key): Factory|View|Application
    {
        $viewModel = new ViewDepartmentViewModel($key);

        return view('backend.domain.academic.departments.show', compact('viewModel'));
    }

    public function edit(string|int $key): Factory|View|Application
    {
        $viewModel = new EditDepartmentViewModel($key);

        return view('backend.domain.academic.departments.edit', compact('viewModel'));
    }

    public function update(string $key, DepartmentUpdateRequest $attributes): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes);

        $this->factory->success(
            "success",
            "un departement modifier"
        );

        return Response::redirectToRoute('admins.academic.departments.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key);

        $this->factory->success(
            "success",
            "un departement supprimer"
        );

        return Response::redirectToRoute('admins.academic.departments.index');
    }
}
