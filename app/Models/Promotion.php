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
 * App\Models\Promotion
 *
 * @property int $id
 * @property string $key
 * @property int $subsidiary_id
 * @property string $name
 * @property string|null $description
 * @property string $images
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $academic_year_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $students
 * @property-read int|null $students_count
 * @property-read \App\Models\Subsidiary|null $subsidiary
 * @method static \Illuminate\Database\Eloquent\Builder|Promotion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Promotion newQuery()
 * @method static \Illuminate\Database\Query\Builder|Promotion onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Promotion query()
 * @method static \Illuminate\Database\Eloquent\Builder|Promotion whereAcademicYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promotion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promotion whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promotion whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promotion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promotion whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promotion whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promotion whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promotion whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promotion whereSubsidiaryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Promotion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Promotion withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Promotion withoutTrashed()
 * @mixin \Eloquent
 */
class Promotion extends Model
{
    use HasFactory, SoftDeletes, HasKeyTrait;

    protected $guarded = [];

    public function subsidiary(): BelongsTo
    {
        return $this->belongsTo(Subsidiary::class, 'subsidiary');
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
