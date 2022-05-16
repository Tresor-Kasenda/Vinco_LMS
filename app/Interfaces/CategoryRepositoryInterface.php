<?php
declare(strict_types=1);

namespace App\Interfaces;

interface CategoryRepositoryInterface
{
    public function getCategories();

    public function showCategory(string $key);

    public function stored($attributes, $flash);

    public function updated(string $key, $attributes, $flash);

    public function deleted(string $key, $flash);

    public function changeStatus($attributes);
}
