<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Chapter
 *
 * @property int $id
 * @property int $course_id
 * @property string $name
 * @property string|null $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read \App\Models\Course $course
 * @property-read Collection|\App\Models\Exercice[] $exercises
 * @property-read int|null $exercises_count
 * @property-read Collection|\App\Models\Homework[] $homeworks
 * @property-read int|null $homeworks_count
 * @property-read Collection|\App\Models\Lesson[] $lessons
 * @property-read int|null $lessons_count
 * @property-read Collection|\App\Models\Question[] $questions
 * @property-read int|null $questions_count
 * @property-read Collection|\App\Models\Resource[] $resources
 * @property-read int|null $resources_count
 * @method static Builder|Chapter newModelQuery()
 * @method static Builder|Chapter newQuery()
 * @method static \Illuminate\Database\Query\Builder|Chapter onlyTrashed()
 * @method static Builder|Chapter query()
 * @method static Builder|Chapter whereContent($value)
 * @method static Builder|Chapter whereCourseId($value)
 * @method static Builder|Chapter whereCreatedAt($value)
 * @method static Builder|Chapter whereDeletedAt($value)
 * @method static Builder|Chapter whereId($value)
 * @method static Builder|Chapter whereName($value)
 * @method static Builder|Chapter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Chapter withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Chapter withoutTrashed()
 * @mixin \Eloquent
 */
class Chapter extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'deleted_at',
    ];

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

    public function resources(): HasMany
    {
        return $this->hasMany(Resource::class);
    }

    public function homeworks(): HasMany
    {
        return $this->hasMany(Homework::class);
    }
}
