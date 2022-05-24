<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Chapter|null $chapter
 * @property-read \App\Models\Course $course
 * @method static \Illuminate\Database\Eloquent\Builder|Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Question newQuery()
 * @method static \Illuminate\Database\Query\Builder|Question onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereChapterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereSchedule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Question whereWeighting($value)
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
