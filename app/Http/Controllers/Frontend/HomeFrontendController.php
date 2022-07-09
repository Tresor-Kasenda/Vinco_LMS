<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend;

use App\Contracts\InstitutionRepositoryInterface;
use App\Contracts\StudentRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\InstitutionRequest;
use App\Http\Requests\StudentRequest;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class HomeFrontendController extends Controller
{
    public function __construct(
        protected readonly InstitutionRepositoryInterface $repository,
        protected readonly StudentRepositoryInterface $repositorys,
        protected readonly SweetAlertFactory $factory
    ) {
    }
    public function index(): Renderable
    {
        return view('frontend.index');
    }

    public function store(InstitutionRequest $request)
    {
        $this->repository->stored($request, $this->factory);
        $this->factory->addSuccess('A new institution has been successfully added');
        return redirect()->route('home.index');
    }

    public function register(){
        return view('frontend.domain.institution.create');
    }

    public function storeStudent(StudentRequest $attributes): RedirectResponse
    {
        $this->repositorys->stored(attributes: $attributes, factory: $this->factory);

        return to_route('home.index');
    }

    public function registerStudent(){
        return view('frontend.domain.student.create');
    }
}
