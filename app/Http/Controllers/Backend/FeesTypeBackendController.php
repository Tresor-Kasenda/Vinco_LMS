<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\FeesTypeRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeeTypeRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class FeesTypeBackendController extends Controller
{
    public function __construct(
        protected readonly FeesTypeRepositoryInterface $repository
    ) {
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

        return redirect()->route('admins.announce.feesTypes.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key);

        return back();
    }
}
