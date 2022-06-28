<?php

declare(strict_types=1);

namespace App\Repositories\System;

use App\Contracts\ChartRepositoryInterface;
use App\Models\Expense;
use App\Models\Fee;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ChartRepository implements ChartRepositoryInterface
{
    public function getFeesByMonth(): array|Collection
    {
        return Fee::query()
            ->select(
                [
                    DB::raw('(COUNT(*)) as count'),
                    DB::raw('MONTHNAME(created_at) as monthname'),
                ]
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('monthname')
            ->get()
            ->toArray();
    }

    public function getExpensesByMonth(): array|Collection|\Illuminate\Support\Collection
    {
        return Expense::query()
            ->select(
                [
                    DB::raw('(COUNT(*)) as count'),
                    DB::raw('MONTHNAME(created_at) as monthname'),
                ]
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('monthname')
            ->get()
            ->toArray();
    }

    public function getStudents()
    {
        return Student::query()
            ->select(
                [
                    'gender',
                    'id',
                    DB::raw('COUNT(id) as order_count'),
                ]
            )
            ->whereIn('gender', ['masculin', 'feminim'])
            ->groupBy('id')
            ->get();
    }

    public function getFeesByWeeks(): array|Collection|\Illuminate\Support\Collection
    {
        return Fee::query()
            ->select(
                [
                    DB::raw('(COUNT(*)) as count'),
                    DB::raw('DAYNAME(created_at) as dayname'),
                ]
            )
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->whereYear('created_at', date('Y'))
            ->groupBy('dayname')
            ->get();
    }

    public function getExpensesByWeeks(): array|Collection|\Illuminate\Support\Collection
    {
        return Expense::query()
            ->select(
                [
                    DB::raw('(COUNT(*)) as count'),
                    DB::raw('DAYNAME(created_at) as dayname'),
                ]
            )
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->whereYear('created_at', date('Y'))
            ->groupBy('dayname')
            ->get();
    }
}
