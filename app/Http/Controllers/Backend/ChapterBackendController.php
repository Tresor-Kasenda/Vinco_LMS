<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\ChapterRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChapterRequest;
use App\Http\Requests\ChapterUpdateRequest;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response;

class ChapterBackendController extends Controller
{
    public function __construct(
        public ChapterRepositoryInterface $repository,
        public SweetAlertFactory $factory,
    ) {
    }

    public function index(): Factory|View|Application
    {
        $chapters = $this->repository->getChapters();

        return \view('backend.domain.academic.chapters.index', compact('chapters'));
    }

    public function create(): Renderable
    {
        return view('backend.domain.academic.chapters.create');
    }

    public function store(ChapterRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes, flash: $this->factory);

        return redirect()->route('admins.academic.chapter.index');
    }

    public function show(string $key): Factory|View|Application
    {
        $chapter = $this->repository->showChapter(key:  $key);

        return view('backend.domain.academic.chapters.show', compact('chapter'));
    }

    public function edit(string $key): HttpResponse
    {
        $chapter = $this->repository->showChapter(key:  $key);

        return Response::view('backend.domain.academic.chapters.edit', compact('chapter'));
    }

    public function update(string $key, ChapterUpdateRequest $attributes): RedirectResponse
    {
        $chapter = $this->repository->updated(key: $key, attributes: $attributes, flash: $this->factory);

        return redirect()->route('admins.academic.chapter.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $chapter = $this->repository->deleted(key: $key, flash: $this->factory);

        return back();
    }
}
