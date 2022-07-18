<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Department
 *
 * @property int $id
 * @property int $campus_id
 * @property string $name
 * @property string|null $description
 * @property string $images
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Campus $campus
 * @property-read Collection|Student[] $students
 * @property-read int|null $students_count
 * @property-read Collection|Subsidiary[] $subdsidiaries
 * @property-read int|null $subdsidiaries_count
 * @property-read Collection|Professor[] $teachers
 * @property-read int|null $teachers_count
 * @property-read Collection|User[] $users
 * @property-read int|null $users_count
 * @method static Builder|Department newModelQuery()
 * @method static Builder|Department newQuery()
 * @method static \Illuminate\Database\Query\Builder|Department onlyTrashed()
 * @method static Builder|Department query()
 * @method static Builder|Department whereCampusId($value)
 * @method static Builder|Department whereCreatedAt($value)
 * @method static Builder|Department whereDeletedAt($value)
 * @method static Builder|Department whereDescription($value)
 * @method static Builder|Department whereId($value)
 * @method static Builder|Department whereImages($value)
 * @method static Builder|Department whereName($value)
 * @method static Builder|Department whereStatus($value)
 * @method static Builder|Department whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Department withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Department withoutTrashed()
 * @mixin \Eloquent
 * @method static \Database\Factories\DepartmentFactory factory(...$parameters)
 */
class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function campus(): BelongsTo
    {
        return $this->belongsTo(Campus::class, 'campus_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_department')
            ->select(['name', 'email'])
            ->withTimestamps();
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Professor::class, 'professors_department');
    }

    public function subdsidiaries(): HasMany
    {
        return $this->hasMany(Subsidiary::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function isActive(): int
    {
        return $this->status = StatusEnum::TRUE;
    }

    public function isInactive(): int
    {
        return $this->status = StatusEnum::FALSE;
    }
}
