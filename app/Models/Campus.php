<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Campus.
 *
 * @property int $id
 * @property string $key
 * @property int $user_id
 * @property string $name
 * @property string|null $description
 * @property string $images
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Department[] $departments
 * @property-read int|null $departments_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Campus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Campus newQuery()
 * @method static \Illuminate\Database\Query\Builder|Campus onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Campus query()
 * @method static \Illuminate\Database\Eloquent\Builder|Campus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campus whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campus whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campus whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campus whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Campus withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Campus withoutTrashed()
 * @mixin \Eloquent
 */
class Campus extends Model
{
    use HasFactory, SoftDeletes, HasKeyTrait;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }
}
