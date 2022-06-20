<?php

declare(strict_types=1);

namespace App\Contracts;

interface SettingRepositoryInterface
{
    public function store($request, $factory);

    public function update(int $id, $request, $factory);

    public function updateSystem(int $id, $request, $factory);
}
