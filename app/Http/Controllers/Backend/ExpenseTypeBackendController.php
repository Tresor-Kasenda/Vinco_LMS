<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\ExpenseTypeRepositoryInterface;
use App\Http\Controllers\Controller;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Support\Renderable;

class ExpenseTypeBackendController extends Controller
{
    public function __construct(
        protected readonly ExpenseTypeRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory
    ) {
    }

    public function index(): Renderable
    {
        $types = $this->repository->getExpensesTypes();

        return view('backend.domain.account.expenseType.index', compact('types'));
    }
}
