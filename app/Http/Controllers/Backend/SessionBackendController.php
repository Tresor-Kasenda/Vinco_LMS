<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcademicYearRequest;
use App\Contracts\AcademicYearRepositoryInterface;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SessionBackendController extends Controller
{
    public function __construct(
        public AcademicYearRepositoryInterface $repository,
        public SweetAlertFactory $flasher
    ) {
    }

    public function index(): Renderable
    {
        return view('backend.domain.academic.index', [
            'academics' => $this->repository->getAcademicsYears(),
        ]);
    }

    public function create(): Renderable
    {
        return view('backend.domain.academic.create');
    }

    public function store(AcademicYearRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes:  $attributes, flash: $this->flasher);

        return to_route('admins.academic-years.index');
    }

    public function edit(string $key): Factory|View|Application
    {
        return view('backend.domain.academic.edit', [
            'academic' => $this->repository->showAcademicYear(key: $key),
        ]);
    }

    public function update(string $key, AcademicYearRequest $attributes): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes, flash: $this->flasher);

        return to_route('admins.academic-years.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key, flash: $this->flasher);

        return back();
    }
}
