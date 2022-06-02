<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfirmPersonnelRequest;
use App\Http\Requests\PersonnelRequest;
use App\Http\Requests\UpdatePersonnelRequest;
use App\Contracts\PersonnelRepositoryInterface;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

final class PersonnelBackendController extends Controller
{
    public function __construct(
        private readonly PersonnelRepositoryInterface $repository,
        private readonly SweetAlertFactory $factory
    ) {
    }

    public function index(): Renderable
    {
        return view('backend.domain.users.personnels.index', [
            'employees' => $this->repository->getPersonnelContent(),
        ]);
    }

    public function show(string $key): Factory|View|Application
    {
        return view('backend.domain.users.personnels.show', [
            'employee' => $this->repository->showPersonnelContent(key:  $key),
        ]);
    }

    public function create(): Renderable
    {
        return view('backend.domain.users.personnels.create');
    }

    public function store(PersonnelRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes, factory: $this->factory);

        return to_route('admins.users.staffs.index');
    }

    public function edit(string $key): Factory|View|Application
    {
        return view('backend.domain.users.personnels.edit', [
            'employee' => $this->repository->showPersonnelContent(key: $key),
        ]);
    }

    public function update(UpdatePersonnelRequest $attributes, string $key): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes, factory: $this->factory);

        return to_route('admins.users.staffs.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key, factory: $this->factory);

        return back();
    }

    public function active(ConfirmPersonnelRequest $request): JsonResponse
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
