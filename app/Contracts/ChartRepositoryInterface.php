<?php

declare(strict_types=1);

namespace App\Contracts;

interface ChartRepositoryInterface
{
    public function getFeesByMonth();

    public function getExpensesByMonth();

    public function getStudents();

    public function getFeesByWeeks();

    public function getExpensesByWeeks();
}
