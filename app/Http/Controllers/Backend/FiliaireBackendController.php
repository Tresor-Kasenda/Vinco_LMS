<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\FiliaireRepositoryInterface;
use App\Http\Requests\FiliaireRequest;
use App\Http\Requests\FiliaireUpdateRequest;
use App\Services\ToastMessageService;
use App\ViewModels\Backend\Section\ViewSectionViewModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as SymfonyHttp;

final class FiliaireBackendController extends BackendBaseController
{
    public function __construct(
        public ToastMessageService $factory,
        protected readonly FiliaireRepositoryInterface $repository
    ) {
        parent::__construct($this->factory);
    }

    public function index(): Renderable
    {
        $filiaires = $this->repository->getFiliaires();

        return view('backend.domain.academic.filiaire.index', compact('filiaires'));
    }

    public function create(): Factory|View|Application
    {
        return view('backend.domain.academic.filiaire.create');
    }

    public function store(FiliaireRequest $attributes): RedirectResponse
    {
        abort_if(Gate::denies('filiaire-create'), SymfonyHttp::HTTP_FORBIDDEN, '403 Forbidden');

        $this->repository->stored(attributes: $attributes);

        $this->factory->success(
            'success',
            'Un nouveau filiaire a ete ajouter'
        );

        return to_route('admins.academic.filiaire.index');
    }

    public function show(string $Key): Factory|View|Application
    {
        $viewModel = new  ViewSectionViewModel($Key);

        return \view('backend.domain.academic.filiaire.show', compact('viewModel'));
    }

    public function edit(string $key): Factory|View|Application
    {
        $filiaire = $this->repository->showFiliaire(key: $key);

        return  view('backend.domain.academic.filiaire.edit', compact('filiaire'));
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key);

        $this->factory->success(
            'success',
            'Un filiaire a ete supprimer'
        );

        return to_route('admins.academic.filiaire.index');
    }

    public function update(FiliaireUpdateRequest $request, string $key): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes:  $request);

        $this->factory->success(
            'success',
            'Un filiaire a ete modifier'
        );

        return to_route('admins.academic.filiaire.index');
    }
}
