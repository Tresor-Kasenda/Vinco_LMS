<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\PromotionRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionRequest;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PromotionBackendController extends Controller
{
    public function __construct(
        protected readonly PromotionRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory,
    ) {
    }

    public function index(): Renderable
    {
        $promotions = $this->repository->getPromotions();

        return view('backend.domain.academic.promotion.index', compact('promotions'));
    }

    public function show(string $key): Factory|View|Application
    {
        $promotion = $this->repository->showPromotion($key);

        return view('backend.domain.academic.promotion.show', compact('promotion'));
    }


    public function create(): Factory|View|Application
    {
        return view('backend.domain.academic.promotion.create');
    }

    public function store(PromotionRequest $request): RedirectResponse
    {
        $this->repository->stored(attributes: $request, factory: $this->factory);

        return redirect()->route('admins.academic.promotion.index');
    }

    public function edit(string $key): Factory|View|Application
    {
        $promotion = $this->repository->showPromotion($key);

        return  view('backend.domain.academic.promotion.edit', compact('promotion'));
    }

    public function update(string $key, PromotionRequest $request): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $request, factory: $this->factory);

        return redirect()->route('admins.academic.promotion.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key, factory: $this->factory);

        return back();
    }
}
