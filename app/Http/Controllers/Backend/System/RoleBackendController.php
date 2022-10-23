<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\System;

use App\Contracts\RoleRepositoryInterface;
use App\Http\Controllers\Backend\BackendBaseController;
use App\Http\Requests\RoleRequest;
use App\Services\ToastMessageService;
use App\ViewModels\Backend\Role\RoleViewModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

final class RoleBackendController extends BackendBaseController
{
    public function __construct(
        public ToastMessageService $factory,
        protected readonly RoleRepositoryInterface $repository,
    ) {
        parent::__construct($this->factory);
    }

    public function index(): Renderable
    {
        $viewModel = new RoleViewModel();

        return view('backend.domain.roles.index', compact('viewModel'));
    }

    public function create(): Factory|View|Application
    {
        $permissions = Permission::query()->get();

        return view('backend.domain.roles.create', compact('permissions'));
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        $this->repository->stored(attributes: $request);

        $this->factory->success(
            'success',
            "Un nouveau role a ete ajouter"
        );

        return redirect()->route('admins.roles.index');
    }

    public function edit(Role $role): Factory|View|Application
    {
        $roleHasPermissions = $role->permissions->pluck('id')->toArray();
        $permissions = Permission::query()->get();

        return view('backend.domain.roles.edit', compact('role', 'permissions', 'roleHasPermissions'));
    }

    public function update($role, RoleRequest $request): RedirectResponse
    {
        $this->repository->updated(role: $role, attributes: $request);

        $this->factory->success(
            'success',
            'Votre mise a jours ete effectuer avec success'
        );

        return redirect()->route('admins.roles.index');
    }

    public function destroy($role): RedirectResponse
    {
        $this->repository->deleted(role: $role);

        $this->factory->success(
            'success',
            "Un element a ete supprimer"
        );

        return back();
    }
}
