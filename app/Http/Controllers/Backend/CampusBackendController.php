<?php
declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonnelRequest;
use App\Http\Requests\ProfessorRequest;
use App\Interfaces\CampusRepositoryInterface;
use App\Interfaces\ProfessorRepositoryInterface;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CampusBackendController extends Controller
{
    public function __construct(
        public CampusRepositoryInterface $repository,
        public SweetAlertFactory $factory
    ){}

    public function index(): Renderable
    {
        return view('backend.domain.campus.index', [
            'campuses' => $this->repository->getCampuses()
        ]);
    }

    public function show(string $key): Factory|View|Application
    {
        return view('backend.domain.campus.show', [
            'campus' => $this->repository->showCampus(key:  $key)
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
}
