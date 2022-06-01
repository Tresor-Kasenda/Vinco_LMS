<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Contracts\TrashedCategoryRepositoryInterface;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Response;

class TrashedCategoryBackendController extends Controller
{
    public function __construct(
        public SweetAlertFactory $alertFactory,
        public TrashedCategoryRepositoryInterface $repository
    ) {
    }

    public function index(): Renderable
    {
        return view('backend.domain.academic.categories.trashed.index', [
            'categories' => $this->repository->getTrashes(),
        ]);
    }

    public function restore(string $key): RedirectResponse
    {
        $this->repository->restore(key: $key, alert: $this->alertFactory);

        return Response::redirectToRoute('admins.academic.categories.index');
    }

    public function destroy(string $key): RedirectResponse
    {
        $this->repository->deleted(key: $key, alert: $this->alertFactory);

        return Response::redirectToRoute('admins.academic.categories.index');
    }
}
