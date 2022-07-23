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
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

final class UsersBackendController extends Controller
{
    public function __construct(
        public UsersRepositoryInterface $repository,
    ) {
    }

    public function index(): \Illuminate\Contracts\View\View
    {
        $admins = $this->repository->getUsers();

        return View::make('backend.domain.users.admin.index', compact('admins'));
    }

    public function create(): Factory|\Illuminate\Contracts\View\View|Application
    {
        return view('backend.domain.users.admin.create');
    }

    public function store(UserRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes);

        return to_route('admins.users.admin.index');
    }

    public function show(string $key): Renderable
    {
        $admin = $this->repository->showUser(key: $key);

        return view('backend.domain.users.admin.show', compact('admin'));
    }

    public function edit(string $key): Factory|\Illuminate\Contracts\View\View|Application
    {
        $admin = $this->repository->showUser(key: $key);

        return view('backend.domain.users.admin.edit', compact('admin'));
    }

    public function update(UserRequest $attributes, string $key): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes);

        return to_route('admins.users.admin.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key);

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
