<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\FeesRepositoryInterface;
use App\Http\Controllers\Controller;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Support\Renderable;

class FeesBackendController extends Controller
{
    public function __construct(
        protected readonly FeesRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory
    ) {
    }

    public function index(): Renderable
    {
        $incomes = $this->repository->getFees();

        return view('backend.domain.account.fees.index', compact('incomes'));
    }
}
