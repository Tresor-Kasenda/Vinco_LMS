<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\System;

use App\Contracts\RoleRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RoleBackendController extends Controller
{
    public function __construct(
        protected readonly RoleRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory
    ) {
    }

    public function index(): Renderable
    {
        $roles = $this->repository->getRoles();

        return view('backend.domain.roles.index', compact('roles'));
    }

    public function create(): Factory|View|Application
    {
        $permissions = Permission::query()->get();

        return view('backend.domain.roles.create', compact('permissions'));
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        $this->repository->stored(attributes: $request, flash: $this->factory);

        return redirect()->route('admins.roles.index');
    }

    public function edit(int $id): Factory|View|Application
    {
        $role = $this->repository->showRole(key: $id);
        $roleHasPermissions = $role->permissions->pluck('id')->toArray();
        $permissions = Permission::query()->get();

        return view('backend.domain.roles.edit', compact('role', 'permissions', 'roleHasPermissions'));
    }

    public function update(int $id, RoleRequest $request): RedirectResponse
    {
        $this->repository->updated(key: $id, attributes: $request, flash: $this->factory);

        return redirect()->route('admins.roles.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->repository->deleted(key: $id, flash: $this->factory);

        return back()->with('success', 'The role has remove with successfull');
    }
}
