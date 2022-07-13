<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\ExpenseRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseRequest;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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

    public function create(): Factory|View|Application
    {
        return view('backend.domain.account.expense.create');
    }

    public function store(ExpenseRequest $request): RedirectResponse
    {
        $this->repository->stored(attributes: $request, factory: $this->factory);

        return redirect()->route('admins.accounting.expenses.index');
    }

    public function edit(string $id): Factory|View|Application
    {
        $expense = $this->repository->showExpense(key: $id);

        return view('backend.domain.account.expense.edit', compact('expense'));
    }

    public function update(string $id, ExpenseRequest $request): RedirectResponse
    {
        $this->repository->updated(key: $id, attributes: $request, factory: $this->factory);

        return redirect()->route('admins.accounting.expenses.index');
    }

    public function destroy(string $id): RedirectResponse
    {
        $this->repository->deleted(key: $id, factory: $this->factory);

        return back();
    }
}
