<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\FiliaireRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\FiliaireRequest;
use App\Http\Requests\FiliaireUpdateRequest;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as SymfonyHttp;

class FiliaireBackendController extends Controller
{
    public function __construct(
        protected readonly FiliaireRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory
    ) {
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
        abort_if(Gate::denies('Subsidiaries-create'), SymfonyHttp::HTTP_FORBIDDEN, '403 Forbidden');

        $this->repository->stored(attributes: $attributes, factory: $this->factory);

        return redirect()->route('admins.academic.filiaire.index');
    }

    public function show(string $Key): Factory|View|Application
    {
        $filiaire = $this->repository->showFiliaire(key:  $Key);

        return \view('backend.domain.academic.filiaire.show', compact('filiaire'));
    }

    public function edit(string $key): Factory|View|Application
    {
        $filiaire = $this->repository->showFiliaire(key: $key);

        return  view('backend.domain.academic.filiaire.edit', compact('filiaire'));
    }

    public function update(FiliaireUpdateRequest $request, string $key): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes:  $request, factory: $this->factory);

        return redirect()->route('admins.academic.filiaire.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key, factory: $this->factory);

        return back();
    }

    public function changeStatus(Request $attributes): bool|int
    {
        $filiaire = $this->repository->showFiliaire(key: $attributes->input('key'));
        if ($filiaire != null) {
            return $filiaire->update([
                'status' => $attributes->input('status'),
            ]);
        }

        return false;
    }
}
