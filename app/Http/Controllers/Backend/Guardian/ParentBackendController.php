<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\Guardian;

use App\Contracts\ParentRepositoryInterface;
use App\Http\Controllers\Backend\BackendBaseController;
use App\Http\Requests\ParentRequest;
use App\Http\Requests\ProfessorUpdateRequest;
use App\Services\ToastMessageService;
use App\ViewModels\Backend\Guardian\ParentViewModel;
use App\ViewModels\Backend\Guardian\ViewParentViewModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

final class ParentBackendController extends BackendBaseController
{
    public function __construct(
        public ToastMessageService $factory,
        protected readonly ParentRepositoryInterface $repository,
    ) {
        parent::__construct($this->factory);
    }

    public function index(): Renderable
    {
        abort_if(Gate::denies('parent-list'), 403);

        $viewModel = new ParentViewModel();

        return view('backend.domain.users.parent.index', compact('viewModel'));
    }

    public function create(): Renderable
    {
        abort_if(Gate::denies('parent-create'), 403);

        return view('backend.domain.users.parent.create');
    }

    public function store(ParentRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes);

        $this->factory->success(
            'success',
            'Un nouveau parent a ete ajouter'
        );

        return to_route('admins.users.guardian.index');
    }

    public function show(string $key): Factory|View|Application
    {
        abort_if(Gate::denies('parent-view'), 403);

        $viewModel = new ViewParentViewModel($key);

        return view('backend.domain.users.parent.show', compact('viewModel'));
    }

    public function edit(string $key): Factory|View|Application
    {
        abort_if(Gate::denies('parent-edit'), 403);

        $parent = $this->repository->showGuardian(key: $key);

        return view('backend.domain.users.parent.edit', compact('parent'));
    }

    public function update(ProfessorUpdateRequest $attributes, string $key): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes);

        $this->factory->success(
            'success',
            'Un parent a ete mise a jours'
        );

        return to_route('admins.users.guardian.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        abort_if(Gate::denies('parent-delete'), 403);

        $this->repository->deleted(key: $key);

        $this->factory->success(
            'success',
            'Un parent a ete supprimer'
        );

        return to_route('admins.users.guardian.index');
    }
}
