<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKeyTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Question.
 *
 * @property int $id
 * @property string $key
 * @property int $course_id
 * @property int|null $chapter_id
 * @property string $name
 * @property string $condition
 * @property int $weighting
 * @property string $date
 * @property string $schedule
 * @property string $duration
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Chapter|null $chapter
 * @property-read Course $course
 * @method static Builder|Question newModelQuery()
 * @method static Builder|Question newQuery()
 * @method static \Illuminate\Database\Query\Builder|Question onlyTrashed()
 * @method static Builder|Question query()
 * @method static Builder|Question whereChapterId($value)
 * @method static Builder|Question whereCondition($value)
 * @method static Builder|Question whereCourseId($value)
 * @method static Builder|Question whereCreatedAt($value)
 * @method static Builder|Question whereDate($value)
 * @method static Builder|Question whereDeletedAt($value)
 * @method static Builder|Question whereDuration($value)
 * @method static Builder|Question whereId($value)
 * @method static Builder|Question whereKey($value)
 * @method static Builder|Question whereName($value)
 * @method static Builder|Question whereSchedule($value)
 * @method static Builder|Question whereStatus($value)
 * @method static Builder|Question whereUpdatedAt($value)
 * @method static Builder|Question whereWeighting($value)
 * @method static \Illuminate\Database\Query\Builder|Question withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Question withoutTrashed()
 * @mixin \Eloquent
 */
class Question extends Model
{
    use HasFactory, SoftDeletes, HasKeyTrait;

    protected $guarded = [];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }
}
