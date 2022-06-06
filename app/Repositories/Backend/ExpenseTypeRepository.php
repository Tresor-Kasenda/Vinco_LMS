<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\ExpenseTypeRepositoryInterface;
use App\Models\ExpenseType;

class ExpenseTypeRepository implements ExpenseTypeRepositoryInterface
{
    public function getExpensesTypes()
    {
        return ExpenseType::query()
            ->orderByDesc('created_at')
            ->get();
    }

    public function showExpenseType(string $key)
    {
        // TODO: Implement showExpenseType() method.
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
