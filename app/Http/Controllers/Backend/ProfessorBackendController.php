<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\ProfessorRepositoryInterface;
use App\Http\Requests\ProfessorRequest;
use App\Http\Requests\ProfessorUpdateRequest;
use App\Services\ToastMessageService;
use App\ViewModels\Backend\Professor\CreateProfessorViewModel;
use App\ViewModels\Backend\Professor\EditProfessorViewModel;
use App\ViewModels\Backend\Professor\ProfessorViewModel;
use App\ViewModels\Backend\Professor\ShowProfessorViewModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class ProfessorBackendController extends BackendBaseController
{
    public function __construct(
        public ToastMessageService $factory,
        protected readonly ProfessorRepositoryInterface $repository,
    ) {
        parent::__construct($this->factory);
    }

    public function index(): Renderable
    {
        $viewModel = new ProfessorViewModel();

        return view('backend.domain.users.teacher.index', compact('viewModel'));
    }

    public function create(): Renderable
    {
        $viewModel = new CreateProfessorViewModel();

        return view('backend.domain.users.teacher.create', compact('viewModel'));
    }

    public function store(ProfessorRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes);

        $this->factory->success(
            'success',
            'Un nouveau professeur a ete ajouter'
        );

        return to_route('admins.users.teacher.index');
    }

    public function show(string|int $key): Factory|View|Application
    {
        $viewModel = new ShowProfessorViewModel($key);

        return view('backend.domain.users.teacher.show', compact('viewModel'));
    }

    public function edit(string|int $key): Factory|View|Application
    {
        $viewModel = new EditProfessorViewModel($key);

        return view('backend.domain.users.teacher.edit', compact('viewModel'));
    }

    public function update(ProfessorUpdateRequest $attributes, string $key): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes);

        $this->factory->success(
            'success',
            'Un  professeur a ete mise a jours'
        );

        return to_route('admins.users.admin.index');
    }

    public function destroy(string|int $key): RedirectResponse
    {
        $this->repository->deleted(key: $key);

        $this->factory->success(
            'success',
            'Un  professeur a ete supprimer'
        );

        return back();
    }
}
