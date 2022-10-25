<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\HomeworkRepositoryInterface;
use App\Http\Requests\HomeworkRequest;
use App\Http\Requests\HomeworkUpdateRequest;
use App\Services\ToastMessageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

final class HomeworkBackendController extends BackendBaseController
{
    public function __construct(
        public ToastMessageService $factory,
        protected readonly HomeworkRepositoryInterface $repository
    ) {
        parent::__construct($this->factory);
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
        $this->repository->stored(attributes: $attributes);

        $this->factory->success(
            'success',
            'Un devoir a ete ajouter'
        );

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
        $this->repository->updated(key: $key, attributes: $attributes);

        $this->factory->success(
            'success',
            'Un devoir a ete modifier'
        );

        return to_route('admins.academic.homework.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key);

        $this->factory->success(
            'success',
            'Un devoir a ete supprimer'
        );

        return back();
    }
}
