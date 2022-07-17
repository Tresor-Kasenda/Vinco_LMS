<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Laratrust\Models\LaratrustPermission;

/**
 * App\Models\Permission
 *
 * @property-read Collection|Role[] $roles
 * @property-read int|null $roles_count
 * @method static Builder|Permission newModelQuery()
 * @method static Builder|Permission newQuery()
 * @method static Builder|Permission query()
 * @mixin \Eloquent
 */
class Permission extends LaratrustPermission
{
    public $guarded = [];
}
