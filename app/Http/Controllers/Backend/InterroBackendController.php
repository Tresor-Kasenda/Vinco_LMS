<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\InterroRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

class InterroBackendController extends Controller
{
    public function __construct(
        protected readonly InterroRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory
    ) {
    }

    public function index(): Renderable
    {
        $interros = [];

        return view('backend.domain.academic.interro.index', compact('interros'));
    }

    public function show(string $key): Factory|View|Application
    {
        $interro = $this->repository->showInterro(key:  $key);

        return view('backend.domain.academic.interro.show', compact('interro'));
    }

    public function create(): Renderable
    {
        $interro = [];

        return view('backend.domain.academic.interro.create', compact('interro'));
    }

    public function store(LessonRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes, factory: $this->factory);

        return to_route('admins.academic.interro.index');
    }

    public function edit(string $key): HttpResponse
    {
        $homework = $this->repository->showInterro(key:  $key);

        return Response::view('backend.domain.academic.interro.edit', compact('homework'));
    }

    public function update(string $key, LessonRequest $attributes): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes, factory: $this->factory);

        return to_route('admins.academic.interro.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key, factory: $this->factory);

        return back();
    }
}
