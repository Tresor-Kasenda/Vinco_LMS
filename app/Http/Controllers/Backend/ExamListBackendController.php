<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\ExamListRepositoryInterface;
use App\Http\Requests\ExamListRequest;
use App\Services\ToastMessageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class ExamListBackendController extends BackendBaseController
{
    public function __construct(
       public ToastMessageService $factory,
        protected readonly ExamListRepositoryInterface $repository
    ) {
        parent::__construct($this->factory);
    }

    public function index(): Renderable
    {
        $exams = $this->repository->exams();

        return view('backend.domain.exam.exams.index', compact('exams'));
    }

    public function create(): Renderable
    {
        return view('backend.domain.exam.exams.create');
    }

    public function store(ExamListRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes);

        return to_route('admins.exam.exam.index');
    }

    public function show(string $key)
    {
        $exam = $this->repository->showExam($key);

        return \Illuminate\Support\Facades\View::make('backend.domain.exam.exams.show')->with('exam', $exam);
    }

    public function edit(string $key): Factory|View|Application
    {
        $exam = $this->repository->showExam($key);

        return view('backend.domain.exam.exams.edit', compact('exam'));
    }

    public function update(ExamListRequest $attributes, string $key): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes);

        return to_route('admins.exam.exam.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key);

        return back();
    }
}
