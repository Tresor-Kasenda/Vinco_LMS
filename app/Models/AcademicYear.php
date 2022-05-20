<?php
declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKeyTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\AcademicYear
 *
 * @property int $id
 * @property string $key
 * @property string $startDate
 * @property string $endDate
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|AcademicYear[] $personnel
 * @property-read int|null $personnel_count
 * @method static Builder|AcademicYear newModelQuery()
 * @method static Builder|AcademicYear newQuery()
 * @method static Builder|AcademicYear query()
 * @method static Builder|AcademicYear whereCreatedAt($value)
 * @method static Builder|AcademicYear whereEndDate($value)
 * @method static Builder|AcademicYear whereId($value)
 * @method static Builder|AcademicYear whereKey($value)
 * @method static Builder|AcademicYear whereStartDate($value)
 * @method static Builder|AcademicYear whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read Collection|Category[] $categories
 * @property-read int|null $categories_count
 */
class AcademicYear extends Model
{
    use HasFactory, HasKeyTrait;

    protected $guarded = [];

    public function personnel(): HasMany
    {
        return $this->hasMany(AcademicYear::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

}
