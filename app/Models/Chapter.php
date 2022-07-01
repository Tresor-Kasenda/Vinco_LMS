<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKeyTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Chapter.
 *
 * @property int $id
 * @property string $key
 * @property int $course_id
 * @property string $name
 * @property string|null $description
 * @property string $displayType
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Course $course
 * @property-read Collection|Exercice[] $exercises
 * @property-read int|null $exercises_count
 * @property-read Collection|Lesson[] $lessons
 * @property-read int|null $lessons_count
 * @property-read Collection|Question[] $questions
 * @property-read int|null $questions_count
 * @method static Builder|Chapter newModelQuery()
 * @method static Builder|Chapter newQuery()
 * @method static \Illuminate\Database\Query\Builder|Chapter onlyTrashed()
 * @method static Builder|Chapter query()
 * @method static Builder|Chapter whereCourseId($value)
 * @method static Builder|Chapter whereCreatedAt($value)
 * @method static Builder|Chapter whereDeletedAt($value)
 * @method static Builder|Chapter whereDescription($value)
 * @method static Builder|Chapter whereDisplayType($value)
 * @method static Builder|Chapter whereId($value)
 * @method static Builder|Chapter whereKey($value)
 * @method static Builder|Chapter whereName($value)
 * @method static Builder|Chapter whereStatus($value)
 * @method static Builder|Chapter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Chapter withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Chapter withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $content
 * @property-read Collection|\App\Models\Homework[] $homeworks
 * @property-read int|null $homeworks_count
 * @property-read Collection|\App\Models\Resource[] $resources
 * @property-read int|null $resources_count
 * @method static Builder|Chapter whereContent($value)
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

    public function resources(): HasMany
    {
        return $this->hasMany(Resource::class);
    }

    public function homeworks(): HasMany
    {
        return $this->hasMany(Homework::class);
    }


}
