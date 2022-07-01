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
 * App\Models\Resource.
 *
 * @property int $id
 * @property string $key
 * @property int $lesson_id
 * @property string $name
 * @property string $files
 * @property string $path
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Lesson $lesson
 * @method static Builder|Resource newModelQuery()
 * @method static Builder|Resource newQuery()
 * @method static \Illuminate\Database\Query\Builder|Resource onlyTrashed()
 * @method static Builder|Resource query()
 * @method static Builder|Resource whereCreatedAt($value)
 * @method static Builder|Resource whereDeletedAt($value)
 * @method static Builder|Resource whereFiles($value)
 * @method static Builder|Resource whereId($value)
 * @method static Builder|Resource whereKey($value)
 * @method static Builder|Resource whereLessonId($value)
 * @method static Builder|Resource whereName($value)
 * @method static Builder|Resource wherePath($value)
 * @method static Builder|Resource whereStatus($value)
 * @method static Builder|Resource whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Resource withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Resource withoutTrashed()
 * @mixin \Eloquent
 * @property int|null $chapter_id
 * @property-read \App\Models\Chapter|null $chapter
 * @method static Builder|Resource whereChapterId($value)
 */
class Resource extends Model
{
    use HasFactory, SoftDeletes, HasKeyTrait;

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
