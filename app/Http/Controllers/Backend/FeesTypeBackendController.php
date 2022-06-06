<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\FeesTypeRepositoryInterface;
use App\Http\Controllers\Controller;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Support\Renderable;

class FeesTypeBackendController extends Controller
{
    public function __construct(
        protected readonly FeesTypeRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory
    ) {
    }

    public function index(): Renderable
    {
        $types = $this->repository->getFeesTypes();

        return view('backend.domain.account.feesType.index', compact('types'));
    }
}
