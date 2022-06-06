<?php

declare(strict_types=1);

namespace App\Contracts;

interface ProfileRepositoryInterface
{
    public function index();

    public function store($attributes);

    public function update(string $key, $attributes);
}
