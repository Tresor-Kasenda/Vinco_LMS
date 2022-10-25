<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\CategoryRepositoryInterface;
use App\Http\Requests\CategoryRequest;
use App\Services\ToastMessageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class CategoryBackendController extends BackendBaseController
{
    public function __construct(
        public ToastMessageService $factory,
        public CategoryRepositoryInterface $repository
    ) {
        parent::__construct($this->factory);
    }

    public function index(): Renderable
    {
        $categories = $this->repository->getCategories();

        return view('backend.domain.academic.categories.index', compact('categories'));
    }

    public function create(): Renderable
    {
        return view('backend.domain.academic.categories.create');
    }

    public function store(CategoryRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes:  $attributes);

        $this->factory->success(
            'success',
            'Une nouvelle categorie a ete ajouter'
        );

        return to_route('admins.academic.categories.index');
    }

    public function edit(string $key): Factory|View|Application
    {
        $category = $this->repository->showCategory(key: $key);

        return view('backend.domain.academic.categories.edit', compact('category'));
    }

    public function update(string $key, CategoryRequest $attributes): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes);

        $this->factory->success(
            'succes',
            'Une categorie a ete modifier'
        );

        return to_route('admins.academic.categories.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key);

        $this->factory->success(
            'success',
            'Une categorie a ete supprimer'
        );

        return to_route('admins.academic.categories.index');
    }
}
