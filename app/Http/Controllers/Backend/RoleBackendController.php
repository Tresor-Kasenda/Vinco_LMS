<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\RoleRepositoryInterface;
use App\Http\Requests\RoleRequest;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\Foundation\Application;
use Symfony\Component\HttpFoundation\Response;

class RoleBackendController extends Controller
{
    public function __construct(
        protected readonly RoleRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory
    ) {
        $this->middleware('can:role-list', ['only' => ['index','show']]);
        $this->middleware('can:role-create', ['only' => ['create','store']]);
        $this->middleware('can:role-edit', ['only' => ['edit','update']]);
        $this->middleware('can:role-delete', ['only' => ['destroy']]);
    }

    public function index(): Renderable
    {
        abort_if(Gate::denies('role-list'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = $this->repository->getRoles();

        return view('backend.domain.roles.index', compact('roles'));
    }

    public function create(): Factory|View|Application
    {
        abort_if(Gate::denies('role-create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
        abort_if(Gate::denies('role-edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role = $this->repository->showRole(key: $id);
        $roleHasPermissions = $role->permissions->pluck('id')->toArray();
        $permissions = Permission::query()->get();
        return view('backend.domain.roles.edit', compact('role', 'permissions', 'roleHasPermissions'));
    }

    public function update(int $id, RoleRequest $request): RedirectResponse
    {
        $role = $this->repository->showRole(key: $id);

        $this->repository->updated(key: $id, attributes: $request, flash: $this->factory);

        return redirect()->route('admins.roles.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        abort_if(Gate::denies('role-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->repository->deleted(key: $id, flash: $this->factory);

        return back()->with('success', "The role has remove with successfull");
    }
}
