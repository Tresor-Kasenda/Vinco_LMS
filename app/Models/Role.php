<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Laratrust\Models\LaratrustRole;

/**
 * App\Models\Role
 *
 * @property-read Collection|Permission[] $permissions
 * @property-read int|null $permissions_count
 * @method static Builder|Role newModelQuery()
 * @method static Builder|Role newQuery()
 * @method static Builder|Role query()
 * @mixin \Eloquent
 */
class Role extends LaratrustRole
{
    public $guarded = [];
}
