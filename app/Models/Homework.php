<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Homework.
 *
 * @property int $id
 * @property int|null $course_id
 * @property int|null $chapter_id
 * @property int|null $lesson_id
 * @property string $name
 * @property float|null $rating_homework
 * @property string|null $filling_date
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Chapter|null $chapter
 * @property-read \App\Models\Course|null $course
 * @property-read \App\Models\Lesson|null $lesson
 *
 * @method static Builder|Homework newModelQuery()
 * @method static Builder|Homework newQuery()
 * @method static Builder|Homework query()
 * @method static Builder|Homework whereChapterId($value)
 * @method static Builder|Homework whereCourseId($value)
 * @method static Builder|Homework whereCreatedAt($value)
 * @method static Builder|Homework whereDeletedAt($value)
 * @method static Builder|Homework whereFillingDate($value)
 * @method static Builder|Homework whereId($value)
 * @method static Builder|Homework whereLessonId($value)
 * @method static Builder|Homework whereName($value)
 * @method static Builder|Homework whereRatingHomework($value)
 * @method static Builder|Homework whereStatus($value)
 * @method static Builder|Homework whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Homework extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
