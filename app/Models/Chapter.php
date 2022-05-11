<?php
declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Chapter
 *
 * @property int $id
 * @property string $key
 * @property int $course_id
 * @property string $name
 * @property string|null $description
 * @property string $displayType
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Course $course
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Exercice[] $exercises
 * @property-read int|null $exercises_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Lesson[] $lessons
 * @property-read int|null $lessons_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Question[] $questions
 * @property-read int|null $questions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter newQuery()
 * @method static \Illuminate\Database\Query\Builder|Chapter onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter query()
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter whereDisplayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Chapter withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Chapter withoutTrashed()
 * @mixin \Eloquent
 */
class Chapter extends Model
{
    use HasFactory, SoftDeletes, HasKeyTrait;

    protected $guarded = [];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercice::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

}
