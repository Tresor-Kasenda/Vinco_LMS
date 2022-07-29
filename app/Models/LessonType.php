<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\LessonType
 *
 * @property-read Lesson|null $lesson
 *
 * @method static Builder|LessonType newModelQuery()
 * @method static Builder|LessonType newQuery()
 * @method static Builder|LessonType query()
 * @mixin \Eloquent
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|LessonType whereCreatedAt($value)
 * @method static Builder|LessonType whereId($value)
 * @method static Builder|LessonType whereName($value)
 * @method static Builder|LessonType whereUpdatedAt($value)
 */
class LessonType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function lesson(): HasOne
    {
        return $this->hasOne(Lesson::class);
    }
}
