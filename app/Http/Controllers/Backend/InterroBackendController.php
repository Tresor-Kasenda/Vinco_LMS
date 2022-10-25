<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\InterroRepositoryInterface;
use App\Http\Requests\InterroRequest;
use App\Http\Requests\InterroUpdateRequest;
use App\Services\ToastMessageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

final class InterroBackendController extends BackendBaseController
{
    public function __construct(
        public ToastMessageService $factory,
        protected readonly InterroRepositoryInterface $repository,
    ) {
        parent::__construct($this->factory);
    }

    public function index(): Renderable
    {
        $interros = $this->repository->interros();

        return view('backend.domain.academic.interro.index', compact('interros'));
    }

    public function create(): Renderable
    {
        return view('backend.domain.academic.interro.create');
    }

    public function store(InterroRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes);

        $this->factory->success(
            'success',
            'Interrogation ajouter avec success'
        );

        return to_route('admins.academic.interro.index');
    }

    public function show(string $key): Factory|View|Application
    {
        $interro = $this->repository->showInterro(key:  $key);

        return view('backend.domain.academic.interro.show', compact('interro'));
    }

    public function edit(string $key): HttpResponse
    {
        $interro = $this->repository->showInterro(key:  $key);

        return Response::view('backend.domain.academic.interro.edit', compact('interro'));
    }

    public function update(string $key, InterroUpdateRequest $attributes): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes);

        $this->factory->success(
            'success',
            'Interrogation modifier avec success'
        );

        return to_route('admins.academic.interro.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key);

        $this->factory->success(
            'success',
            'Interrogation supprimer avec success'
        );

        return back();
    }
}
