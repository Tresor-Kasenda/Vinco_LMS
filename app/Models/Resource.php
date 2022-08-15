<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Resource
 *
 * @property int $id
 * @property int|null $lesson_id
 * @property int|null $chapter_id
 * @property string $name
 * @property string|null $files
 * @property string|null $path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read \App\Models\Chapter|null $chapter
 * @property-read \App\Models\Lesson|null $lesson
 * @method static Builder|Resource newModelQuery()
 * @method static Builder|Resource newQuery()
 * @method static \Illuminate\Database\Query\Builder|Resource onlyTrashed()
 * @method static Builder|Resource query()
 * @method static Builder|Resource whereChapterId($value)
 * @method static Builder|Resource whereCreatedAt($value)
 * @method static Builder|Resource whereDeletedAt($value)
 * @method static Builder|Resource whereFiles($value)
 * @method static Builder|Resource whereId($value)
 * @method static Builder|Resource whereLessonId($value)
 * @method static Builder|Resource whereName($value)
 * @method static Builder|Resource wherePath($value)
 * @method static Builder|Resource whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Resource withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Resource withoutTrashed()
 * @mixin \Eloquent
 */
final class Resource extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }
}
