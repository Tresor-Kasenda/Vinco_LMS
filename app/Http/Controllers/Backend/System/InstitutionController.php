<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend\System;

use App\Contracts\InstitutionRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\InstitutionRequest;
use App\Http\Requests\UpdateInstitutionRequest;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Gate;

class InstitutionController extends Controller
{
    public function __construct(
        protected readonly InstitutionRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory
    ) {
    }

    public function index(): Renderable
    {
        $institutions = $this->repository->getInstitutions();

        return view('backend.domain.institution.index', compact('institutions'));
    }

    public function create()
    {
        return view('backend.domain.institution.create');
    }

    public function store(InstitutionRequest $request)
    {
        $this->repository->stored($request, $this->factory);

        $this->factory->addSuccess('A new institution has been successfully added');

        return redirect()->route('admins.institution.index');
    }

    public function show(string $id)
    {
        $institution = $this->repository->showInstitution($id);

        return view('backend.domain.institution.show', compact('institution'));
    }

    public function edit(string $id)
    {
        $institution = $this->repository->showInstitution($id);

        return view('backend.domain.institution.edit', compact('institution'));
    }

    public function update(string $id, UpdateInstitutionRequest $request)
    {
        $this->repository->updated(key: $id, attributes: $request);

        $this->factory->addSuccess('the institution was successfully modified ');

        return redirect()->route('admins.institution.index');
    }

    public function destroy(string $id)
    {
        abort_if(Gate::allows('institution-delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $this->repository->deleted($id);

        $this->factory->addSuccess('the institution was successfully suspended');

        return back();
    }
}
