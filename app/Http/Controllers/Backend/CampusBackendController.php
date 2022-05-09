<?php
declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CampusRequest;
use App\Http\Requests\CampusStatusRequest;
use App\Interfaces\CampusRepositoryInterface;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as HttpResponse;

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

    public function store(CampusRequest $attributes): RedirectResponse
    {
        $this->repository->stored(attributes: $attributes, factory: $this->factory);
        return to_route('admins.campus.index');
    }

    public function edit(string $key): HttpResponse
    {
        return Response::view('backend.domain.campus.edit', [
            'campus' => $this->repository->showCampus(key: $key)
        ]);
    }

    public function update(string $key, CampusRequest $attributes): RedirectResponse
    {
        $this->repository->updated(key: $key, attributes: $attributes, factory: $this->factory);
        return Response::redirectToRoute('admins.campus.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key, factory: $this->factory);
        return Response::redirectToRoute('admins.campus.index');
    }

    public function activate(CampusStatusRequest $request): JsonResponse
    {
        $employee = $this->repository->changeStatus(attributes: $request);
        if ($employee){
            return response()->json([
                'message' => "The status has been successfully updated"
            ]);
        }
        return response()->json([
            'message' => "Desoler"
        ]);
    }
}
