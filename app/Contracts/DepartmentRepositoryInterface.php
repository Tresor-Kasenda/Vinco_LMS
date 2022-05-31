<?php

declare(strict_types=1);

namespace App\Contracts;

interface DepartmentRepositoryInterface
{
    public function getDepartments();

    public function showDepartment(string $key);

    public function stored($attributes, $factory);

    public function updated(string $key, $attributes, $factory);

    public function deleted(string $key, $factory);

    public function changeStatus($attributes);
}
