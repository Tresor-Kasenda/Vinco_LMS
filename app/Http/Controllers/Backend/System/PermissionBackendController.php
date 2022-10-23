<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\Backend\BackendBaseController;
use App\Http\Requests\Permission\StorePermissionRequest;
use App\Repositories\System\PermissionBackendRepository;
use App\Services\ToastMessageService;
use App\ViewModels\Backend\Permission\EditPermissionViewModel;
use App\ViewModels\Backend\Permission\ViewPermissionViewModel;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;

class PermissionBackendController extends BackendBaseController
{
    public function __construct(
        public ToastMessageService $factory,
        protected PermissionBackendRepository $repository
    ) {
        parent::__construct($this->factory);
    }

    public function index(): Renderable
    {
        $viewModel = new ViewPermissionViewModel();

        return view('backend.domain.permission.index', compact('viewModel'));
    }

    public function create(): Renderable
    {
        return view('backend.domain.permission.create');
    }

    public function store(StorePermissionRequest $request): RedirectResponse
    {
        $this->repository->store($request);

        $this->factory->success(
            'success',
            'Une nouvelle permission ajouter'
        );

        return redirect()->route('admins.permissions.index');
    }

    public function edit(Permission $permission)
    {
        $viewModel = new EditPermissionViewModel($permission);

        return view('backend.domain.permission.edit', compact('viewModel'));
    }

    public function update(Permission $permission, StorePermissionRequest $request)
    {
        $this->repository->update($permission, $request);
        $this->factory->success(
            'success',
            "L'operation effectuez avec succes"
        );

        return redirect()->route('admins.permissions.index');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        $this->repository->delete($permission);

        $this->factory->success(
            'success',
            'Permission supprimer avec success'
        );

        return back();
    }
}
