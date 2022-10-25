<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\PromotionRepositoryInterface;
use App\Http\Requests\PromotionRequest;
use App\Http\Requests\PromotionUpdateRequest;
use App\Services\ToastMessageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class PromotionBackendController extends BackendBaseController
{
    public function __construct(
        public ToastMessageService $factory,
        protected readonly PromotionRepositoryInterface $repository
    ) {
        parent::__construct($this->factory);
    }

    public function index(): Renderable
    {
        $promotions = $this->repository->getPromotions();

        return view('backend.domain.academic.promotion.index', compact('promotions'));
    }

    public function create(): Factory|View|Application
    {
        return view('backend.domain.academic.promotion.create');
    }

    public function store(PromotionRequest $request): RedirectResponse
    {
        $this->repository->stored(attributes: $request);

        $this->factory->success(
            'success',
            'Une nouvelle promotion a ete ajouter'
        );

        return redirect()->route('admins.academic.promotion.index');
    }

    public function show(string $key): Factory|View|Application
    {
        $promotion = $this->repository->showPromotion($key);

        return view('backend.domain.academic.promotion.show', compact('promotion'));
    }

    public function edit(string $key): Factory|View|Application
    {
        $promotion = $this->repository->showPromotion($key);

        return  view('backend.domain.academic.promotion.edit', compact('promotion'));
    }

    public function update(string $key, PromotionUpdateRequest $request): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $request);

        $this->factory->success(
            'success',
            'Une promotion a ete modifier'
        );

        return redirect()->route('admins.academic.promotion.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key);

        return to_route('admins.academic.promotion.index');
    }
}
