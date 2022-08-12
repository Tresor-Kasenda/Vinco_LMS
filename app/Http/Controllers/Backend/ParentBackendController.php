<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\ParentRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ParentRequest;
use App\Http\Requests\ProfessorUpdateRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class ParentBackendController extends Controller
{
    public function __construct(
        protected readonly ParentRepositoryInterface $repository,
    ) {
    }

    public function index(): Renderable
    {
        $parents = $this->repository->guardians();

        return view('backend.domain.users.parent.index', compact('parents'));
    }

    public function create(): Renderable
    {
        return view('backend.domain.users.parent.create');
    }

    public function store(ParentRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes);

        return to_route('admins.users.guardian.index');
    }

    public function show(string $key): Factory|View|Application
    {
        $parent = $this->repository->showGuardian(key: $key);

        return view('backend.domain.users.parent.show', compact('parent'));
    }

    public function edit(string $key): Factory|View|Application
    {
        $parent = $this->repository->showGuardian(key: $key);

        return view('backend.domain.users.parent.edit', compact('parent'));
    }

    public function update(ProfessorUpdateRequest $attributes, string $key): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes);

        return to_route('admins.users.guardian.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key);

        return back();
    }
}
