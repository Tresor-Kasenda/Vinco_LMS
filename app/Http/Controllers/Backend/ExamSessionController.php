<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\ExamSessionRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExamSessionRequest;
use App\Http\Requests\ExamSessionUpdateRequest;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Support\Facades\View;

final class ExamSessionController extends Controller
{
    public function __construct(
        protected readonly ExamSessionRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory
    ) {
    }

    public function index()
    {
        $sessionExams = $this->repository->getExamSessions();

        return View::make('backend.domain.exam.exam-sessions.index')->with('sessionExams', $sessionExams);
    }

    public function create()
    {
        return View::make('backend.domain.exam.exam-sessions.create');
    }

    public function store(ExamSessionRequest $attributes)
    {
        $this->repository->stored(attributes: $attributes, factory: $this->factory);

        return to_route('admins.exam.session-exams.index');
    }

    public function edit(string $key)
    {
        $sessionExam = $this->repository->showExamSession(key: $key);

        return View::make('backend.domain.exam.exam-sessions.edit')->with('sessionExam', $sessionExam);
    }

    public function update(string $key, ExamSessionUpdateRequest $attributes)
    {
        $this->repository->updated(key: $key, attributes: $attributes, factory: $this->factory);

        return to_route('admins.exam.session-exams.index');
    }

    public function destroy(string $key)
    {
        $this->repository->deleted($key, $this->factory);

        return back();
    }
}
