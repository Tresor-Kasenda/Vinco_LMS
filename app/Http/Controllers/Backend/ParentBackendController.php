<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\ParentRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfirmerProfessorRequest;
use App\Http\Requests\ParentRequest;
use App\Http\Requests\ProfessorRequest;
use App\Http\Requests\ProfessorUpdateRequest;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ParentBackendController extends Controller
{
    public function __construct(
        protected readonly ParentRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory
    ) {
        $this->middleware('can:parent-list', ['only' => ['index', 'show']]);
        $this->middleware('can:parent-create', ['only' => ['create', 'store']]);
        $this->middleware('can:parent-edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:parent-delete', ['only' => ['destroy']]);
    }

    public function index(): Renderable
    {
        abort_unless(request()->user()->can('parent-list'), 403);

        $parents = $this->repository->guardians();

        return view('backend.domain.users.parent.index', compact('parents'));
    }

    public function show(string $key): Factory|View|Application
    {
        abort_if(Gate::denies('parent-view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parent = $this->repository->showGuardian(key: $key);

        return view('backend.domain.users.parent.show', compact('parent'));
    }

    public function create(): Renderable
    {
        abort_if(Gate::denies('parent-create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('backend.domain.users.parent.create');
    }

    public function store(ParentRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes, factory: $this->factory);

        return to_route('admins.users.guardian.index');
    }

    public function edit(string $key): Factory|View|Application
    {
        $parent = $this->repository->showGuardian(key: $key);

        return view('backend.domain.users.parent.edit', compact('parent'));
    }

    public function update(ProfessorUpdateRequest $attributes, string $key): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes, factory: $this->factory);

        return to_route('admins.users.guardian.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key, factory: $this->factory);

        return back();
    }

    public function activate(ConfirmerProfessorRequest $request): JsonResponse
    {
        $employee = $this->repository->changeStatus(attributes: $request);
        if ($employee) {
            return response()->json([
                'message' => 'The status has been successfully updated',
            ]);
        }

        return response()->json([
            'message' => 'Desoler',
        ]);
    }
}
