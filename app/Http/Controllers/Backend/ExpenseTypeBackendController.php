<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Contracts\ExpenseTypeRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseTypeRequest;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ExpenseTypeBackendController extends Controller
{
    public function __construct(
        protected readonly ExpenseTypeRepositoryInterface $repository,
        protected readonly SweetAlertFactory $factory
    ) {
    }

    public function index(): Renderable
    {
        $expenseTypes = $this->repository->getExpensesTypes();

        return view('backend.domain.account.expenseType.index', compact('expenseTypes'));
    }

    public function create(): Factory|View|Application
    {
        return view('backend.domain.account.expenseType.create');
    }

    public function store(ExpenseTypeRequest $request): RedirectResponse
    {
        $this->repository->stored(attributes: $request, factory:  $this->factory);

        return redirect()->route('admins.announce.expenseTypes.index');
    }

    public function edit(string $id): Factory|View|Application
    {
        $expenseType = $this->repository->showExpenseType(key: $id);

        return view('backend.domain.account.expenseType.edit', compact('expenseType'));
    }

    public function update(string $id, ExpenseTypeRequest $request): RedirectResponse
    {
        $this->repository->updated(key: $id, attributes: $request, factory: $this->factory);

        return redirect()->route('admins.announce.expenseTypes.index');
    }

    public function destroy(string $id): RedirectResponse
    {
        $this->repository->deleted(key: $id, factory: $this->factory);

        return back();
    }
}
