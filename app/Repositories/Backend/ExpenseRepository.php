<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\ExpenseRepositoryInterface;
use App\Models\Expense;
use Illuminate\Database\Eloquent\Collection;

class ExpenseRepository implements ExpenseRepositoryInterface
{
    public function getExpenses(): Collection|array
    {
        return Expense::query()
            ->orderByDesc('created_at')
            ->get();
    }

    public function showExpense(string $key)
    {
        // TODO: Implement showExpense() method.
    }

    public function stored($attributes, $factory)
    {
        // TODO: Implement stored() method.
    }

    public function updated(string $key, $attributes, $factory)
    {
        // TODO: Implement updated() method.
    }

    public function deleted(string $key, $factory)
    {
        // TODO: Implement deleted() method.
    }
}
