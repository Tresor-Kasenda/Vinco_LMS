<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Homework.
 *
 * @property int $id
 * @property string $key
 * @property int|null $course_id
 * @property int|null $chapter_id
 * @property int|null $lesson_id
 * @property string $name
 * @property int|null $weighting
 * @property string $schedule
 * @property string|null $duration
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|Homework newModelQuery()
 * @method static Builder|Homework newQuery()
 * @method static Builder|Homework query()
 * @method static Builder|Homework whereChapterId($value)
 * @method static Builder|Homework whereCourseId($value)
 * @method static Builder|Homework whereCreatedAt($value)
 * @method static Builder|Homework whereDeletedAt($value)
 * @method static Builder|Homework whereDuration($value)
 * @method static Builder|Homework whereId($value)
 * @method static Builder|Homework whereKey($value)
 * @method static Builder|Homework whereLessonId($value)
 * @method static Builder|Homework whereName($value)
 * @method static Builder|Homework whereSchedule($value)
 * @method static Builder|Homework whereStatus($value)
 * @method static Builder|Homework whereUpdatedAt($value)
 * @method static Builder|Homework whereWeighting($value)
 * @mixin \Eloquent
 */
class Homework extends Model
{
    use HasFactory;
}
