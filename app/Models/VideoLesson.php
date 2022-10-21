<?php

declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\VideoLesson.
 *
 * @property int $id
 * @property int $lesson_id
 * @property string $video_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Lesson $lesson
 *
 * @method static Builder|VideoLesson newModelQuery()
 * @method static Builder|VideoLesson newQuery()
 * @method static \Illuminate\Database\Query\Builder|VideoLesson onlyTrashed()
 * @method static Builder|VideoLesson query()
 * @method static Builder|VideoLesson whereCreatedAt($value)
 * @method static Builder|VideoLesson whereDeletedAt($value)
 * @method static Builder|VideoLesson whereId($value)
 * @method static Builder|VideoLesson whereLessonId($value)
 * @method static Builder|VideoLesson whereUpdatedAt($value)
 * @method static Builder|VideoLesson whereVideoName($value)
 * @method static \Illuminate\Database\Query\Builder|VideoLesson withTrashed()
 * @method static \Illuminate\Database\Query\Builder|VideoLesson withoutTrashed()
 * @mixin Eloquent
 */
final class VideoLesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'video_lessons';

    protected $fillable = [
        'video_name',
        'lesson_id',
    ];

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
