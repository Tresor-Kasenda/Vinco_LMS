<?php
declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\TrashedPersonnelRepositoryInterface;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Response;

class TrashedPersonnelBackendController extends Controller
{
    public function __construct(
        public SweetAlertFactory $alertFactory,
        public TrashedPersonnelRepositoryInterface $repository
    ){}

    public function index(): Renderable
    {
        return view('backend.domain.personnels.trashed.index', [
            'employees' => $this->repository->getTrashes()
        ]);
    }

    public function restore(string $key): RedirectResponse
    {
        $this->repository->restore(key: $key, alert: $this->alertFactory);
        return Response::redirectToRoute('admins.personnel.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key, alert: $this->alertFactory);
        return Response::redirectToRoute('admins.personnel.index');
    }
}
