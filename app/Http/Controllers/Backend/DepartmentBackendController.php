<?php
declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfessorRequest;
use App\Interfaces\DepartmentRepositoryInterface;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class DepartmentBackendController extends Controller
{
    public function __construct(
        public DepartmentRepositoryInterface $repository,
        public SweetAlertFactory $factory
    ){}

    public function index(): Renderable
    {
        return view('backend.domain.campus.departments.index', [
            'departments' => $this->repository->getDepartments()
        ]);
    }

    public function show(string $key): Factory|View|Application
    {
        return view('backend.domain.campus.show', [
            'campus' => $this->repository->showDepartment(key:  $key)
        ]);
    }

    public function create(): Renderable
    {
        return view('backend.domain.campus.create');
    }

    public function store(ProfessorRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes, factory: $this->factory);
        return to_route('admins.campus.index');
    }

    public function edit(string $key): Factory|View|Application
    {
        return view('backend.domain.campus.departments.edit', [
            'department' => $this->repository->showDepartment(key:  $key)
        ]);
    }
}
