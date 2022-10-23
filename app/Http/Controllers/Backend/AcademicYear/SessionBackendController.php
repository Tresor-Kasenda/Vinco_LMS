<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\AcademicYear;

use App\Contracts\AcademicYearRepositoryInterface;
use App\Http\Controllers\Backend\BackendBaseController;
use App\Http\Requests\SessionRequest;
use App\Http\Requests\SessionUpdateRequest;
use App\Services\ToastMessageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

final class SessionBackendController extends BackendBaseController
{
    public function __construct(
        public AcademicYearRepositoryInterface $repository,
        public ToastMessageService $factory
    ) {
        parent::__construct($this->factory);
    }

    public function index(): Renderable
    {
        abort_if(Gate::denies('academic-year-list'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $academics = $this->repository->getAcademicsYears();

        return view('backend.domain.academic.index')->with('academics', $academics);
    }

    public function create(): Renderable
    {
        return view('backend.domain.academic.create');
    }

    public function store(SessionRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes:  $attributes);

        $this->factory->success(
            'success',
            "Une nouvelle session a ete enregistrer"
        );

        return to_route('admins.academic.session.index');
    }

    public function edit(int $session): Factory|View|Application
    {
        $academic = $this->repository->show($session);
        return view('backend.domain.academic.edit', compact('academic'));
    }

    public function update(int $academicYear, SessionUpdateRequest $attributes): RedirectResponse
    {
        $this->repository->updated(academic: $academicYear, attributes: $attributes);

        $this->factory->success(
            'success',
            "Une session a ete mises a jours"
        );

        return to_route('admins.academic.session.index');
    }

    public function destroy(int $academicYear): RedirectResponse
    {
        $this->repository->deleted(academic: $academicYear);
        $this->factory->success(
            'success',
            "Une session a ete supprimer"
        );
        return back();
    }
}
