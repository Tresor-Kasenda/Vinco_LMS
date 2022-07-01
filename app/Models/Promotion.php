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
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Promotion.
 *
 * @property int $id
 * @property string $key
 * @property int $subsidiary_id
 * @property string $name
 * @property string|null $description
 * @property string $images
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $academic_year_id
 * @property-read Collection|Student[] $students
 * @property-read int|null $students_count
 * @property-read Subsidiary|null $subsidiary
 * @method static Builder|Promotion newModelQuery()
 * @method static Builder|Promotion newQuery()
 * @method static \Illuminate\Database\Query\Builder|Promotion onlyTrashed()
 * @method static Builder|Promotion query()
 * @method static Builder|Promotion whereAcademicYearId($value)
 * @method static Builder|Promotion whereCreatedAt($value)
 * @method static Builder|Promotion whereDeletedAt($value)
 * @method static Builder|Promotion whereDescription($value)
 * @method static Builder|Promotion whereId($value)
 * @method static Builder|Promotion whereImages($value)
 * @method static Builder|Promotion whereKey($value)
 * @method static Builder|Promotion whereName($value)
 * @method static Builder|Promotion whereStatus($value)
 * @method static Builder|Promotion whereSubsidiaryId($value)
 * @method static Builder|Promotion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Promotion withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Promotion withoutTrashed()
 * @mixin Eloquent
 * @property-read AcademicYear $academic
 * @property-read Collection|\App\Models\Event[] $events
 * @property-read int|null $events_count
 * @property-read \App\Models\Schedule|null $schedules
 */
class Promotion extends Model
{
    use HasFactory, SoftDeletes, HasKeyTrait;

    protected $guarded = [];

    public function subsidiary(): BelongsTo
    {
        return $this->belongsTo(Subsidiary::class, 'subsidiary_id');
    }

    public function academic(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function schedules(): HasOne
    {
        return $this->hasOne(Schedule::class);
    }

}
