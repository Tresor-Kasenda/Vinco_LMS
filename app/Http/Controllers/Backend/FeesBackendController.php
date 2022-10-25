<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\FeesRepositoryInterface;
use App\Http\Requests\FeeRequest;
use App\Models\Fee;
use App\Services\ToastMessageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class FeesBackendController extends BackendBaseController
{
    public function __construct(
        public ToastMessageService $factory,
        protected readonly FeesRepositoryInterface $repository
    ) {
        parent::__construct($this->factory);
    }

    public function index(): Renderable
    {
        $fees = $this->repository->getFees();

        return view('backend.domain.account.fees.index', compact('fees'));
    }

    public function create(): Factory|View|Application
    {
        return view('backend.domain.account.fees.create');
    }

    public function store(FeeRequest $request): RedirectResponse
    {
        $this->repository->stored(attributes: $request);

        $this->factory->success(
            'success',
            'Un nouveau frais ajouter'
        );

        return redirect()->route('admins.accounting.fees.index');
    }

    public function show(Fee $fee): Renderable
    {
        return \view('backend.domain.account.fees.show', compact('fee'));
    }

    public function edit(int $id): Factory|View|Application
    {
        $fee = $this->repository->showFee(key: $id);

        return \view('backend.domain.account.fees.edit', compact('fee'));
    }

    public function update(int $id, FeeRequest $request): RedirectResponse
    {
        $this->repository->updated(key: $id, attributes: $request);

        $this->factory->success(
            'success',
            'Un frais a ete modifier'
        );

        return redirect()->route('admins.accounting.fees.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->repository->deleted(key: $id);

        $this->factory->success(
            'success',
            'Un frais a ete supprimer'
        );

        return back();
    }
}
