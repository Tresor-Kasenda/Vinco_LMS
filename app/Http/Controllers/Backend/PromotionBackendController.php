<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Contracts\PromotionRepositoryInterface;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PromotionBackendController extends Controller
{
    public function __construct(
        protected readonly PromotionRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory,
    ) {
    }

    public function index(): Renderable
    {
        $promotions = [];
        return view('backend.domain.academic.promotion.index', compact('promotions'));
    }

    public function create(): Factory|View|Application
    {
        return view('backend.domain.academic.promotion.create');
    }

    public function store()
    {
    }

    public function edit(): Factory|View|Application
    {
        return  view('backend.domain.academic.promotion.edit');
    }

    public function update(string $key)
    {
    }

    public function destroy(string $key)
    {
    }
}
