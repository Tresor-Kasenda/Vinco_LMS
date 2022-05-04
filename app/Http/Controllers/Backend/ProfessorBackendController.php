<?php
declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonnelRequest;
use App\Http\Requests\ProfessorRequest;
use App\Interfaces\ProfessorRepositoryInterface;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProfessorBackendController extends Controller
{
    public function __construct(
        public ProfessorRepositoryInterface $repository,
        public SweetAlertFactory $factory
    ){}

    public function index(): Renderable
    {
        return view('backend.domain.professors.index', [
            'professors' => $this->repository->getProfessors()
        ]);
    }

    public function show(string $key): Factory|View|Application
    {
        return view('backend.domain.professors.show', [
            'professor' => $this->repository->showProfessor(key:  $key)
        ]);
    }

    public function create(): Renderable
    {
        return view('backend.domain.personnels.create');
    }

    public function store(ProfessorRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes, factory: $this->factory);
        return to_route('admins.personnel.index');
    }
}
