<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\AcademicYearRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\SessionRequest;
use App\Http\Requests\SessionUpdateRequest;
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
        $academics = $this->repository->getAcademicsYears();

        return view('backend.domain.academic.index')->with('academics', $academics);
    }

    public function create(): Renderable
    {
        return view('backend.domain.academic.create');
    }

    public function store(SessionRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes:  $attributes, flash: $this->flasher);

        return to_route('admins.academic.session.index');
    }

    public function edit(string $key): Factory|View|Application
    {
        $academic = $this->repository->showAcademicYear(key: $key);

        return view('backend.domain.academic.edit', compact('academic'));
    }

    public function update(string $key, SessionUpdateRequest $attributes): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes, flash: $this->flasher);

        return to_route('admins.academic.session.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key, flash: $this->flasher);

        return back();
    }
}
