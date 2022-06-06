<?php
declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\ExpenseRepositoryInterface;
use App\Http\Controllers\Controller;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Support\Renderable;

class ExpenseBackendController extends Controller
{
    public function __construct(
        protected readonly ExpenseRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory
    ) {
    }

    public function index(): Renderable
    {
        $expenses = $this->repository->getExpenses();

        return view('backend.domain.account.expense.index', compact('expenses'));
    }
}
