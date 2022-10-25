<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\Campus;

use App\Contracts\CampusRepositoryInterface;
use App\Http\Controllers\Backend\BackendBaseController;
use App\Http\Requests\CampusRequest;
use App\Http\Requests\CampusUpdateRequest;
use App\Services\ToastMessageService;
use App\ViewModels\Backend\Campus\CampusViewModel;
use App\ViewModels\Backend\Campus\CreateCampusViewModel;
use App\ViewModels\Backend\Campus\ShowCampusViewModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

final class CampusBackendController extends BackendBaseController
{
    public function __construct(
        public ToastMessageService $factory,
        protected readonly CampusRepositoryInterface $repository
    ) {
        parent::__construct($this->factory);
    }

    public function index(): Renderable
    {
        $viewModel = new CampusViewModel();

        return view('backend.domain.academic.campus.index', compact('viewModel'));
    }

    public function create(): Renderable
    {
        $viewModel = new CreateCampusViewModel();

        return view('backend.domain.academic.campus.create', compact('viewModel'));
    }

    public function store(CampusRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes);

        $this->factory->success(
            'success',
            'Un campus ajouter avec success'
        );

        return redirect()->route('admins.academic.campus.index');
    }

    public function show(string|int $key): Factory|View|Application
    {
        $viewModel = new ShowCampusViewModel($key);

        return view('backend.domain.academic.campus.show', compact('viewModel'));
    }

    public function edit(string $key): HttpResponse
    {
        $campus = $this->repository->showCampus(key:  $key);

        return Response::view('backend.domain.academic.campus.edit', compact('campus'));
    }

    public function update(string $key, CampusUpdateRequest $attributes): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes);

        $this->factory->success(
            'success',
            'Un campus modifier avec success'
        );

        return Response::redirectToRoute('admins.academic.campus.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key);

        $this->factory->success(
            'success',
            'Un campus supprimer avec success'
        );

        return Response::redirectToRoute('admins.academic.campus.index');
    }
}
