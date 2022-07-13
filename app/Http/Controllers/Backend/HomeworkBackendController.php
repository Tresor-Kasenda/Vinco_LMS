<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\HomeworkRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\HomeworkRequest;
use App\Http\Requests\HomeworkUpdateRequest;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

class HomeworkBackendController extends Controller
{
    public function __construct(
        protected readonly HomeworkRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory
    ) {
    }

    public function index(): Renderable
    {
        $homeworks = $this->repository->homeworks();

        return view('backend.domain.academic.homework.index', compact('homeworks'));
    }

    public function create(): Renderable
    {
        return view('backend.domain.academic.homework.create');
    }

    public function store(HomeworkRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes, factory: $this->factory);

        return to_route('admins.academic.homework.index');
    }

    public function show(string $key): Factory|View|Application
    {
        $homework = $this->repository->showHomework(key:  $key);

        return view('backend.domain.academic.homework.show', compact('homework'));
    }

    public function edit(string $key): HttpResponse
    {
        $homework = $this->repository->showHomework(key:  $key);

        return Response::view('backend.domain.academic.homework.edit', compact('homework'));
    }

    public function update(string $key, HomeworkUpdateRequest $attributes): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes, factory: $this->factory);

        return to_route('admins.academic.homework.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key, factory: $this->factory);

        return back();
    }
}
