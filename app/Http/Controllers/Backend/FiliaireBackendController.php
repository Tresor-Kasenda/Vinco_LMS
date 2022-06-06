<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Contracts\FiliaireRepositoryInterface;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class FiliaireBackendController extends Controller
{
    public function __construct(
        protected readonly FiliaireRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory
    ) {
    }

    public function index(): Renderable
    {
        $filiaires = [];
        return view('backend.domain.academic.filiaire.index', compact('filiaires'));
    }

    public function create(): Factory|View|Application
    {
        return view('backend.domain.academic.filiaire.create');
    }

    public function store()
    {
    }

    public function edit(): Factory|View|Application
    {
        return  view('backend.domain.academic.filiaire.edit');
    }

    public function update(string $key)
    {
    }

    public function destroy(string $key)
    {
    }
}
