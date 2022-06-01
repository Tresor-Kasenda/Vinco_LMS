<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CampusRequest;
use App\Http\Requests\CampusStatusRequest;
use App\Contracts\CampusRepositoryInterface;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

class CampusBackendController extends Controller
{
    public function __construct(
        public CampusRepositoryInterface $repository,
        public SweetAlertFactory $factory
    ) {
    }

    public function index(): Renderable
    {
        $faculties = $this->repository->getCampuses();

        return view('backend.domain.academic.campus.index', compact('faculties'));
    }

    public function show(string $key): Factory|View|Application
    {
        return view('backend.domain.academic.campus.show', [
            'campus' => $this->repository->showCampus(key:  $key),
        ]);
    }

    public function create(): Renderable
    {
        return view('backend.domain.academic.campus.create');
    }

    public function store(CampusRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes, factory: $this->factory);

        return to_route('admins.academic.campus.index');
    }

    public function edit(string $key): HttpResponse
    {
        return Response::view('backend.domain.campus.edit', [
            'campus' => $this->repository->showCampus(key: $key),
        ]);
    }

    public function update(string $key, CampusRequest $attributes): RedirectResponse
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
