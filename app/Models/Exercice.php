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
 * App\Models\Exercice.
 *
 * @property int $id
 * @property string $key
 * @property int $course_id
 * @property int|null $chapter_id
 * @property int|null $lesson_id
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
 * @property-read Lesson|null $lesson
 * @method static Builder|Exercice newModelQuery()
 * @method static Builder|Exercice newQuery()
 * @method static \Illuminate\Database\Query\Builder|Exercice onlyTrashed()
 * @method static Builder|Exercice query()
 * @method static Builder|Exercice whereChapterId($value)
 * @method static Builder|Exercice whereCondition($value)
 * @method static Builder|Exercice whereCourseId($value)
 * @method static Builder|Exercice whereCreatedAt($value)
 * @method static Builder|Exercice whereDate($value)
 * @method static Builder|Exercice whereDeletedAt($value)
 * @method static Builder|Exercice whereDuration($value)
 * @method static Builder|Exercice whereId($value)
 * @method static Builder|Exercice whereKey($value)
 * @method static Builder|Exercice whereLessonId($value)
 * @method static Builder|Exercice whereName($value)
 * @method static Builder|Exercice whereSchedule($value)
 * @method static Builder|Exercice whereStatus($value)
 * @method static Builder|Exercice whereUpdatedAt($value)
 * @method static Builder|Exercice whereWeighting($value)
 * @method static \Illuminate\Database\Query\Builder|Exercice withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Exercice withoutTrashed()
 * @mixin \Eloquent
 * @property float|null $rating
 * @property string|null $filling_date
 * @method static Builder|Exercice whereFillingDate($value)
 * @method static Builder|Exercice whereRating($value)
 */
class Exercice extends Model
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

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }
}
