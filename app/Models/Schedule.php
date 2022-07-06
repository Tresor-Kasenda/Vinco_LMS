<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Schedule.
 *
 * @property int $id
 * @property int $promotion_id
 * @property int $course_id
 * @property string|null $start_time
 * @property string|null $end_time
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Course $course
 * @property-read Promotion $promotion
 * @method static Builder|Schedule newModelQuery()
 * @method static Builder|Schedule newQuery()
 * @method static Builder|Schedule query()
 * @method static Builder|Schedule whereCourseId($value)
 * @method static Builder|Schedule whereCreatedAt($value)
 * @method static Builder|Schedule whereEndTime($value)
 * @method static Builder|Schedule whereId($value)
 * @method static Builder|Schedule wherePromotionId($value)
 * @method static Builder|Schedule whereStartTime($value)
 * @method static Builder|Schedule whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $date
 * @method static Builder|Schedule whereDate($value)
 */
class Schedule extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function promotion(): BelongsTo
    {
        return $this->belongsTo(Promotion::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
