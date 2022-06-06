<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\TrashedCourseRepositoryInterface;
use App\Http\Controllers\Controller;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Response;

class TrashedCourseBackendController extends Controller
{
    public function __construct(
        public SweetAlertFactory $alertFactory,
        public TrashedCourseRepositoryInterface $repository
    ) {
    }

    public function index(): Renderable
    {
        return view('backend.domain.academic.cours.trashed.index', [
            'courses' => $this->repository->getTrashes(),
        ]);
    }

    public function restore(string $key): RedirectResponse
    {
        $this->repository->restore(key: $key, alert: $this->alertFactory);

        return Response::redirectToRoute('admins.academic.course.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key, alert: $this->alertFactory);

        return Response::redirectToRoute('admins.academic.course.index');
    }
}
