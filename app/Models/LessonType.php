<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\LessonType
 *
 * @property-read \App\Models\Lesson|null $lesson
 * @method static \Illuminate\Database\Eloquent\Builder|LessonType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LessonType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LessonType query()
 * @mixin \Eloquent
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
