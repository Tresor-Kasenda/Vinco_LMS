<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\SettingRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Http\Requests\SystemRequest;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class SettingsBackendController extends Controller
{
    public function __construct(
        protected readonly SettingRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory
    ) {
    }

    public function index(): Renderable
    {
        $times = new \Jackiedo\Timezonelist\Timezonelist();

        return view('backend.domain.setting.index', compact('times'));
    }

    public function store(SettingRequest $request): RedirectResponse
    {
        $this->repository->store(request: $request, factory: $this->factory);

        return back();
    }

    public function update(int $id, SettingRequest $request): RedirectResponse
    {
        $this->repository->update(id: $id, request: $request, factory: $this->factory);

        return back();
    }

    /**
     * @param  SystemRequest  $request
     */
    public function updateSystem(int $id, Request $request): RedirectResponse
    {
        $this->repository->updateSystem(id: $id, request: $request, factory: $this->factory);

        return back();
    }
}
