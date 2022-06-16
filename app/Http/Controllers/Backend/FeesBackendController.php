<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\FeesRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeeRequest;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class FeesBackendController extends Controller
{
    public function __construct(
        protected readonly FeesRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory
    ) {
    }

    public function index(): Renderable
    {
        $incomes = $this->repository->getFees();

        return view('backend.domain.account.fees.index', compact('incomes'));
    }

    public function create(): Factory|View|Application
    {
        return view('backend.domain.account.fees.create');
    }

    public function store(FeeRequest $request): RedirectResponse
    {
        $this->repository->stored(attributes: $request, factory: $this->factory);

        return redirect()->route('admins.accounting.fees.index');
    }

    public function edit(int $id): Factory|View|Application
    {
        $fee = $this->repository->showFee(key: $id);

        return \view('backend.domain.account.fees.edit', compact('fee'));
    }

    public function update(int $id, FeeRequest $request): RedirectResponse
    {
        $this->repository->updated(key: $id, attributes: $request, factory: $this->factory);

        return redirect()->route('admins.accounting.fees.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->repository->deleted(key: $id,factory: $this->factory);

        return back();
    }

}
