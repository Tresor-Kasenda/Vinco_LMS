<?php
declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Exercice
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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Chapter|null $chapter
 * @property-read \App\Models\Course $course
 * @property-read \App\Models\Lesson|null $lesson
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice newQuery()
 * @method static \Illuminate\Database\Query\Builder|Exercice onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice query()
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice whereChapterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice whereCondition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice whereLessonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice whereSchedule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Exercice whereWeighting($value)
 * @method static \Illuminate\Database\Query\Builder|Exercice withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Exercice withoutTrashed()
 * @mixin \Eloquent
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
