<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\ExamFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Exam
 *
 * @property int $id
 * @property int $course_id
 * @property float|null $rating
 * @property string|null $date
 * @property string|null $duration
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Course $course
 *
 * @method static Builder|Exam newModelQuery()
 * @method static Builder|Exam newQuery()
 * @method static \Illuminate\Database\Query\Builder|Exam onlyTrashed()
 * @method static Builder|Exam query()
 * @method static Builder|Exam whereCourseId($value)
 * @method static Builder|Exam whereCreatedAt($value)
 * @method static Builder|Exam whereDate($value)
 * @method static Builder|Exam whereDeletedAt($value)
 * @method static Builder|Exam whereDuration($value)
 * @method static Builder|Exam whereId($value)
 * @method static Builder|Exam whereRating($value)
 * @method static Builder|Exam whereStatus($value)
 * @method static Builder|Exam whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Exam withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Exam withoutTrashed()
 * @mixin Eloquent
 *
 * @property string|null $start_time
 * @property int $exam_id
 * @property-read ExamSession|null $examSession
 *
 * @method static ExamFactory factory(...$parameters)
 * @method static Builder|Exam whereExamId($value)
 * @method static Builder|Exam whereStartTime($value)
 *
 * @property int $exam_session_id
 *
 * @method static Builder|Exam whereExamSessionId($value)
 */
final class Exam extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function examSession(): BelongsTo
    {
        return $this->belongsTo(ExamSession::class);
    }
}
