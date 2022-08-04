<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\AcademicYearFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\AcademicYear.
 *
 * @property int $id
 * @property string $start_date
 * @property string $end_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Category[] $categories
 * @property-read int|null $categories_count
 * @property-read Collection|AcademicYear[] $personnel
 * @property-read int|null $personnel_count
 *
 * @method static Builder|AcademicYear newModelQuery()
 * @method static Builder|AcademicYear newQuery()
 * @method static Builder|AcademicYear query()
 * @method static Builder|AcademicYear whereCreatedAt($value)
 * @method static Builder|AcademicYear whereEndDate($value)
 * @method static Builder|AcademicYear whereId($value)
 * @method static Builder|AcademicYear whereStartDate($value)
 * @method static Builder|AcademicYear whereUpdatedAt($value)
 * @mixin Eloquent
 *
 * @property int $institution_id
 *
 * @method static AcademicYearFactory factory(...$parameters)
 * @method static Builder|AcademicYear whereInstitutionId($value)
 *
 * @property-read \App\Models\Institution $institution
 */
class AcademicYear extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function personnel(): HasMany
    {
        return $this->hasMany(self::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }
}
