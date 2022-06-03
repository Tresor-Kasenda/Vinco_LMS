<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\UsersRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfirmUserRequest;
use App\Http\Requests\UserRequest;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\View;

final class UsersBackendController extends Controller
{
    public function __construct(
        public UsersRepositoryInterface $repository,
        public SweetAlertFactory $factory
    ) {
    }

    public function index(): \Illuminate\Contracts\View\View
    {
        return View::make('backend.domain.users.admin.index', [
           'admins' => $this->repository->getUsers(),
        ]);
    }

    public function show(string $key): Renderable
    {
        return view('backend.domain.users.admin.show', [
            'admin' => $this->repository->showUser(key: $key),
        ]);
    }

    public function create(): Factory|\Illuminate\Contracts\View\View|Application
    {
        return view('backend.domain.users.admin.create');
    }

    public function store(UserRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes, flash: $this->factory);

        return to_route('admins.users.admin.index');
    }

    public function edit(string $key): Factory|\Illuminate\Contracts\View\View|Application
    {
        return view('backend.domain.users.admin.edit', [
            'administrator' => $this->repository->showUser(key: $key),
        ]);
    }

    public function update(UserRequest $attributes, string $key): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes, flash: $this->factory);

        return to_route('admins.users.admin.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key, flash: $this->factory);

        return to_route('admins.users.admin.index');
    }

    public function activate(ConfirmUserRequest $request): JsonResponse
    {
        $administrator = $this->repository->changeStatus(attributes: $request);
        if (! $administrator) {
            return response()->json(['message' => 'Desoler']);
        }

        return response()->json([
            'message' => 'The status has been successfully updated',
        ]);
    }
}
