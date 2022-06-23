<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\ExpenseTypeRepositoryInterface;
use App\Models\ExpenseType;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ExpenseTypeRepository implements ExpenseTypeRepositoryInterface
{
    use ImageUploader;

    public function getExpensesTypes(): array|Collection|\Illuminate\Support\Collection
    {
        return Cache::remember('expenseTypes', 1000, function () {
            return ExpenseType::query()
                ->orderByDesc('created_at')
                ->get();
        });
    }

    public function showExpenseType(string $key): Model|Builder|ExpenseType
    {
        return ExpenseType::query()
            ->where('id', '=', $key)
            ->firstOrFail();
    }

    public function stored($attributes, $factory): Model|Builder|ExpenseType
    {
        $expenseType = ExpenseType::query()
            ->create([
               'name' => $attributes->input('name'),
               'image' => self::uploadFiles(request: $attributes)
            ]);

        $factory->addSuccess('Expense type added with successfully');
        return $expenseType;
    }

    public function updated(string $key, $attributes, $factory): Model|Builder|ExpenseType
    {
        $expenseType = $this->showExpenseType(key: $key);
        $this->removePathOfImage($expenseType);
        $expenseType->update([
            'name' => $attributes->input('name'),
            'image' => self::uploadFiles(request: $attributes)
        ]);

        $factory->addSuccess('Expense type modified with successfully');
        return $expenseType;
    }

    public function deleted(string $key, $factory): Model|Builder|ExpenseType
    {
        $expenseType = $this->showExpenseType(key: $key);
        $this->removePathOfImage($expenseType);
        $expenseType->delete();
        $factory->addSuccess('Expense type deleted with successfully');
        return $expenseType;
    }
}
