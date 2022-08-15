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
 * App\Models\LessonFiles
 *
 * @property int $id
 * @property int $lesson_id
 * @property string $files
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Lesson $lesson
 *
 * @method static Builder|LessonFiles newModelQuery()
 * @method static Builder|LessonFiles newQuery()
 * @method static \Illuminate\Database\Query\Builder|LessonFiles onlyTrashed()
 * @method static Builder|LessonFiles query()
 * @method static Builder|LessonFiles whereCreatedAt($value)
 * @method static Builder|LessonFiles whereDeletedAt($value)
 * @method static Builder|LessonFiles whereFiles($value)
 * @method static Builder|LessonFiles whereId($value)
 * @method static Builder|LessonFiles whereLessonId($value)
 * @method static Builder|LessonFiles whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|LessonFiles withTrashed()
 * @method static \Illuminate\Database\Query\Builder|LessonFiles withoutTrashed()
 * @mixin Eloquent
 */
final class LessonFiles extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'files',
        'lesson_id',
    ];

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function getLessonFiles(): string
    {
        return asset('storage/lesson/files/'.$this->files);
    }
}
