<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\PersonnelRepositoryInterface;
use App\Http\Requests\PersonnelRequest;
use App\Http\Requests\UpdatePersonnelRequest;
use App\Services\ToastMessageService;
use App\ViewModels\Backend\Admin\EditPersonnelViewModel;
use App\ViewModels\Backend\Admin\PersonnelViewModel;
use App\ViewModels\Backend\Personnel\ShowPersonnelViewModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class PersonnelBackendController extends BackendBaseController
{
    public function __construct(
        public ToastMessageService $factory,
        private readonly PersonnelRepositoryInterface $repository
    ) {
        parent::__construct($this->factory);
    }

    public function index(): Renderable
    {
        $employees = $this->repository->getPersonnelContent();

        return view('backend.domain.users.personnels.index', compact('employees'));
    }

    public function create(): Renderable
    {
        $viewModel = new PersonnelViewModel();

        return view('backend.domain.users.personnels.create', compact('viewModel'));
    }

    public function store(PersonnelRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes);

        $this->factory->success(
            'success',
            "Un nouveau personnel ajouter"
        );

        return to_route('admins.users.staffs.index');
    }

    public function show(string|int $key): Factory|View|Application
    {
        $viewModel = new ShowPersonnelViewModel($key);

        return view('backend.domain.users.personnels.show', compact('viewModel'));
    }

    public function edit(int|string $key): Factory|View|Application
    {
        $viewModel = new EditPersonnelViewModel($key);

        return view('backend.domain.users.personnels.edit', compact('viewModel'));
    }

    public function update(UpdatePersonnelRequest $attributes, string $key): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes);

        $this->factory->success(
            'success',
            "Un personnel a ete modifier"
        );

        return to_route('admins.users.staffs.index');
    }

    public function destroy(string|int $key): RedirectResponse
    {
        $this->repository->deleted(key: $key);

        $this->factory->success(
            'success',
            "Un personnel a ete supprimer"
        );


        return back();
    }
}
