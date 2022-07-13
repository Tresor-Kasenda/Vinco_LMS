<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\CampusRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CampusRequest;
use App\Http\Requests\CampusStatusRequest;
use App\Http\Requests\CampusUpdateRequest;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

class CampusBackendController extends Controller
{
    public function __construct(
        protected readonly CampusRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory
    ) {
    }

    public function index(): Renderable
    {
        $campuses = $this->repository->getCampuses();

        return view('backend.domain.academic.campus.index', compact('campuses'));
    }

    public function show(string $key): Factory|View|Application
    {
        $campus = $this->repository->showCampus(key:  $key);

        return view('backend.domain.academic.campus.show', compact('campus'));
    }

    public function create(): Renderable
    {
        return view('backend.domain.academic.campus.create');
    }

    public function store(CampusRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes, factory: $this->factory);

        return redirect()->route('admins.academic.campus.index');
    }

    public function edit(string $key): HttpResponse
    {
        $campus = $this->repository->showCampus(key:  $key);

        return Response::view('backend.domain.academic.campus.edit', compact('campus'));
    }

    public function update(string $key, CampusUpdateRequest $attributes): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes, factory: $this->factory);

        return Response::redirectToRoute('admins.academic.campus.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key, factory: $this->factory);

        return Response::redirectToRoute('admins.academic.campus.index');
    }

    public function activate(CampusStatusRequest $request): JsonResponse
    {
        $campus = $this->repository->changeStatus(attributes: $request);

        return response()->json(['message' => 'The status has been successfully updated'])
            ??
            response()->json(['message' => 'Desoler']);
    }
}
