<?php
declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Exam
 *
 * @property int $id
 * @property string $key
 * @property int $course_id
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
 * @property-read \App\Models\Course $course
 * @method static \Illuminate\Database\Eloquent\Builder|Exam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Exam newQuery()
 * @method static \Illuminate\Database\Query\Builder|Exam onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Exam query()
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereSchedule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exam whereWeighting($value)
 * @method static \Illuminate\Database\Query\Builder|Exam withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Exam withoutTrashed()
 * @mixin \Eloquent
 */
class Exam extends Model
{
    use HasFactory, SoftDeletes, HasKeyTrait;

    protected $guarded = [];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
