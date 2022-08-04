<?php

declare(strict_types=1);

namespace App\Contracts;

interface CategoryRepositoryInterface
{
    public function getCategories();

    public function showCategory(string $key);

    public function stored($attributes);

    public function updated(string $key, $attributes);

    public function deleted(string $key);
}
