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
 * App\Models\Subsidiary.
 *
 * @property int $id
 * @property string $key
 * @property int $department_id
 * @property int $user_id
 * @property string $name
 * @property string|null $description
 * @property string $images
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $academic_year_id
 * @property-read \App\Models\Department $department
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Promotion[] $promotions
 * @property-read int|null $promotions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $students
 * @property-read int|null $students_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Subsidiary newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subsidiary newQuery()
 * @method static \Illuminate\Database\Query\Builder|Subsidiary onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Subsidiary query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subsidiary whereAcademicYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subsidiary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subsidiary whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subsidiary whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subsidiary whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subsidiary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subsidiary whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subsidiary whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subsidiary whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subsidiary whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subsidiary whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subsidiary whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Subsidiary withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Subsidiary withoutTrashed()
 * @mixin \Eloquent
 */
class Subsidiary extends Model
{
    use HasFactory, SoftDeletes, HasKeyTrait;

    protected $guarded = [];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
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
