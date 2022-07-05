<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKeyTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Subsidiary.
 *
 * @property int $id
 * @property int $department_id
 * @property int $user_id
 * @property string $name
 * @property string|null $description
 * @property string $images
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AcademicYear $academic
 * @property-read Department $department
 * @property-read Collection|Promotion[] $promotions
 * @property-read int|null $promotions_count
 * @property-read Collection|Student[] $students
 * @property-read int|null $students_count
 * @property-read User $user
 * @method static Builder|Subsidiary newModelQuery()
 * @method static Builder|Subsidiary newQuery()
 * @method static \Illuminate\Database\Query\Builder|Subsidiary onlyTrashed()
 * @method static Builder|Subsidiary query()
 * @method static Builder|Subsidiary whereCreatedAt($value)
 * @method static Builder|Subsidiary whereDeletedAt($value)
 * @method static Builder|Subsidiary whereDepartmentId($value)
 * @method static Builder|Subsidiary whereDescription($value)
 * @method static Builder|Subsidiary whereId($value)
 * @method static Builder|Subsidiary whereImages($value)
 * @method static Builder|Subsidiary whereName($value)
 * @method static Builder|Subsidiary whereUpdatedAt($value)
 * @method static Builder|Subsidiary whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Subsidiary withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Subsidiary withoutTrashed()
 * @mixin Eloquent
 */
class Subsidiary extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function academic(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }

    public function promotions(): HasMany
    {
        return $this->hasMany(Promotion::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
