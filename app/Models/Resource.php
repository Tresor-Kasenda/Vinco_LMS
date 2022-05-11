<?php
declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Resource
 *
 * @property int $id
 * @property string $key
 * @property int $lesson_id
 * @property string $name
 * @property string $files
 * @property string $path
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Lesson $lesson
 * @method static \Illuminate\Database\Eloquent\Builder|Resource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource newQuery()
 * @method static \Illuminate\Database\Query\Builder|Resource onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource query()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereFiles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereLessonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Resource withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Resource withoutTrashed()
 * @mixin \Eloquent
 */
class Resource extends Model
{
    use HasFactory, SoftDeletes, HasKeyTrait;

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }
}
