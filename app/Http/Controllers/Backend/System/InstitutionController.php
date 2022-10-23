<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\System;

use App\Contracts\InstitutionRepositoryInterface;
use App\Http\Controllers\Backend\BackendBaseController;
use App\Http\Requests\InstitutionRequest;
use App\Http\Requests\UpdateInstitutionRequest;
use App\Services\ToastMessageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class InstitutionController extends BackendBaseController
{
    public function __construct(
        public ToastMessageService $factory,
        protected readonly InstitutionRepositoryInterface $repository
    ) {
        parent::__construct($this->factory);
    }

    public function index(): Renderable
    {
        $institutions = $this->repository->getInstitutions();

        return view('backend.domain.institution.index', compact('institutions'));
    }

    public function create(): Renderable
    {
        return view('backend.domain.institution.create');
    }

    public function store(InstitutionRequest $request): RedirectResponse
    {
        $this->repository->stored($request);

        $this->factory->success(
            'success',
            'Une nouvelle institution a ete ajouter'
        );

        return redirect()->route('admins.institution.index');
    }

    public function show(string $id): Factory|View|Application
    {
        $institution = $this->repository->showInstitution($id);

        return view('backend.domain.institution.show', compact('institution'));
    }

    public function edit(string $id): Factory|View|Application
    {
        $institution = $this->repository->showInstitution($id);

        return view('backend.domain.institution.edit', compact('institution'));
    }

    public function update(string $id, UpdateInstitutionRequest $request): RedirectResponse
    {
        $this->repository->updated(key: $id, attributes: $request);

        $this->factory->success(
            'success',
            'Une institution a ete modifier'
        );

        return redirect()->route('admins.institution.index');
    }

    public function destroy(string $id): RedirectResponse
    {
        $this->repository->deleted($id);

        $this->factory->success(
            'success',
            'Une institution a ete supprimer'
        );

        return back();
    }
}
