<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\FeesTypeRepositoryInterface;
use App\Http\Requests\FeeTypeRequest;
use App\Services\ToastMessageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class FeesTypeBackendController extends BackendBaseController
{
    public function __construct(
        public ToastMessageService $factory,
        protected readonly FeesTypeRepositoryInterface $repository
    ) {
        parent::__construct($this->factory);
    }

    public function index(): Renderable
    {
        $feesTypes = $this->repository->getFeesTypes();

        return view('backend.domain.account.feesType.index', compact('feesTypes'));
    }

    public function create(): Renderable
    {
        return view('backend.domain.account.feesType.create');
    }

    public function store(FeeTypeRequest $feeTypeRequest): RedirectResponse
    {
        $this->repository->stored(attributes: $feeTypeRequest);

        $this->factory->success(
            'success',
            'Un nouveau type de frais ajouter'
        );

        return redirect()->route('admins.announce.feesTypes.index');
    }

    public function edit(string $key): Factory|View|Application
    {
        $feesType = $this->repository->showFeeType(key:  $key);

        return view('backend.domain.account.feesType.edit', compact('feesType'));
    }

    public function update(string $key, FeeTypeRequest $feeTypeRequest): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $feeTypeRequest);

        $this->factory->success(
            'success',
            'Un type de frais modifier'
        );

        return redirect()->route('admins.announce.feesTypes.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key);

        $this->factory->success(
            'success',
            'Un type de frais supprimer'
        );

        return back();
    }
}
