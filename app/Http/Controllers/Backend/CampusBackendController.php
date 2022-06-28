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
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyHttp;

class CampusBackendController extends Controller
{
    public function __construct(
        protected readonly CampusRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory
    ) {
    }

    public function index(): Renderable
    {
        abort_if(Gate::allwos('campus-list'), SymfonyHttp::HTTP_FORBIDDEN, '403 Forbidden');

        $faculties = $this->repository->getCampuses();

        return view('backend.domain.academic.campus.index', compact('faculties'));
    }

    public function show(string $key): Factory|View|Application
    {
        abort_if(Gate::allwos('campus-show'), SymfonyHttp::HTTP_FORBIDDEN, '403 Forbidden');

        $campus = $this->repository->showCampus(key:  $key);

        return view('backend.domain.academic.campus.show', compact('campus'));
    }

    public function create(): Renderable
    {
        return view('backend.domain.academic.campus.create');
    }

    public function store(CampusRequest $attributes): RedirectResponse
    {
        abort_if(Gate::allwos('campus-create'), SymfonyHttp::HTTP_FORBIDDEN, '403 Forbidden');

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
        abort_if(Gate::allows('campus-edit'), SymfonyHttp::HTTP_FORBIDDEN, '403 Forbidden');

        $this->repository->updated(key: $key, attributes: $attributes, factory: $this->factory);

        return Response::redirectToRoute('admins.academic.campus.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        abort_if(Gate::allwos('campus-delete'), SymfonyHttp::HTTP_FORBIDDEN, '403 Forbidden');

        $this->repository->deleted(key: $key, factory: $this->factory);

        return Response::redirectToRoute('admins.academic.campus.index');
    }

    public function activate(CampusStatusRequest $request): JsonResponse
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
