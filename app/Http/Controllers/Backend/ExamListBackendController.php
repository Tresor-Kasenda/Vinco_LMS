<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\ExamListRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExamListRequest;
use App\Http\Requests\ProfessorRequest;
use App\Http\Requests\ProfessorUpdateRequest;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ExamListBackendController extends Controller
{
    public function __construct(
        protected readonly SweetAlertFactory $factory,
        protected readonly ExamListRepositoryInterface $repository
    ) {
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

    public function store(Request $attributes): RedirectResponse
    {
        dd($attributes);
        $this->repository->stored(attributes: $attributes, factory: $this->factory);

        return to_route('admins.exam.exam.index');
    }

    public function edit(string $key): Factory|View|Application
    {
        $exam = $this->repository->showExam($key);

        return view('backend.domain.exam.exams.edit', compact('exam'));
    }

    public function update(ExamListRequest $attributes, string $key): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes, factory: $this->factory);

        return to_route('admins.exam.exam.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key, factory: $this->factory);

        return back();
    }
}
