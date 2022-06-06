<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\TrashedProfessorRepositoryInterface;
use App\Http\Controllers\Controller;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Response;

class TrashedProfessorBackendController extends Controller
{
    public function __construct(
        public SweetAlertFactory $alertFactory,
        public TrashedProfessorRepositoryInterface $repository
    ) {
    }

    public function index(): Renderable
    {
        return view('backend.domain.users.teacher.trashed.index', [
            'teacher' => $this->repository->getTrashes(),
        ]);
    }

    public function restore(string $key): RedirectResponse
    {
        $this->repository->restore(key: $key, alert: $this->alertFactory);

        return Response::redirectToRoute('admins.users.teacher.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key, alert: $this->alertFactory);

        return Response::redirectToRoute('admins.users.teacher.index');
    }
}
