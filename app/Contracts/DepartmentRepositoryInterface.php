<?php

declare(strict_types=1);

namespace App\Contracts;

interface DepartmentRepositoryInterface
{
    public function getDepartments();

    public function showDepartment(string $key);

    public function stored($attributes);

    public function updated(string $key, $attributes);

    public function deleted(string $key);

    public function changeStatus($attributes);
}
