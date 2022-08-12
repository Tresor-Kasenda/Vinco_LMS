<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\ExpenseRepositoryInterface;
use App\Models\Expense;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class ExpenseRepository implements ExpenseRepositoryInterface
{
    public function getExpenses(): Collection|array
    {
        return Expense::query()
            ->select([
                'id',
                'amount',
                'description',
                'institution_id',
                'expense_type_id',
            ])
            ->with(['types', 'institution'])
            ->orderByDesc('created_at')
            ->get();
    }

    public function showExpense(string $key): Model|Builder|Expense
    {
        $expense = Expense::query()
            ->whereId($key)
            ->first();

        return $expense->load(['types', 'institution']);
    }

    public function stored($attributes, $factory): Model|Builder|Expense
    {
        $expense = Expense::query()
            ->create([
                'amount' => $attributes->input('amount'),
                'description' => $attributes->input('description'),
                'expense_type_id' => $attributes->input('expense'),
                'institution_id' => $attributes->input('institution'),
            ]);

        $factory->addSuccess('Expense added with successfully');

        return $expense;
    }

    public function updated(string $key, $attributes, $factory): Model|Builder|Expense
    {
        $expense = $this->showExpense(key: $key);
        $expense->update([
            'amount' => $attributes->input('amount'),
            'description' => $attributes->input('description'),
            'expense_type_id' => $attributes->input('expense'),
            'institution_id' => $attributes->input('institution'),
        ]);
        $factory->addSuccess('Expense updated with successfully');

        return $expense;
    }

    public function deleted(string $key, $factory): Model|Builder|Expense
    {
        $expense = $this->showExpense(key: $key);
        $expense->delete();
        $factory->addSuccess('Expense updated with successfully');

        return $expense;
    }
}
