<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Contracts\ProfileRepositoryInterface;
use App\Models\Profile;
use App\Traits\ImageUploader;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

final class ProfileRepository implements ProfileRepositoryInterface
{
    use ImageUploader;

    public function index(): Model|Builder|null
    {
        return Profile::query()
            ->whereBelongsTo(auth()->user())
            ->first();
    }

    public function store($attributes)
    {
        // TODO: Implement store() method.
    }

    public function update(string $key, $attributes)
    {
        // TODO: Implement update() method.
    }
}
