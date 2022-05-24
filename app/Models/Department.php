<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKeyTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Department.
 *
 * @property int $id
 * @property string $key
 * @property int $campus_id
 * @property string $name
 * @property string|null $description
 * @property string $images
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Campus $campus
 * @property-read Collection|\App\Models\Professor[] $professors
 * @property-read int|null $professors_count
 * @property-read Collection|\App\Models\Student[] $students
 * @property-read int|null $students_count
 * @property-read Collection|\App\Models\Subsidiary[] $subdsidiaries
 * @property-read int|null $subdsidiaries_count
 * @property-read Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department newQuery()
 * @method static \Illuminate\Database\Query\Builder|Department onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Department query()
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereCampusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Department withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Department withoutTrashed()
 * @mixin \Eloquent
 */
class Department extends Model
{
    use HasFactory, SoftDeletes, HasKeyTrait;

    protected $guarded = [];

    public function campus(): BelongsTo
    {
        return $this->belongsTo(Campus::class, 'campus_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_department')
            ->withTimestamps();
    }

    public function professors(): HasMany
    {
        return $this->hasMany(Professor::class);
    }

    public function subdsidiaries(): HasMany
    {
        return $this->hasMany(Subsidiary::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
