<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Course.
 *
 * @property int $id
 * @property int $category_id
 * @property int $professor_id
 * @property string $name
 * @property string|null $sub_description
 * @property string|null $description
 * @property string|null $images
 * @property int|null $weighting
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Category $category
 * @property-read Collection|Chapter[] $chapters
 * @property-read int|null $chapters_count
 * @property-read Collection|Exam[] $exams
 * @property-read int|null $exams_count
 * @property-read Collection|Exercice[] $exercises
 * @property-read int|null $exercises_count
 * @property-read Collection|Homework[] $homeworks
 * @property-read int|null $homeworks_count
 * @property-read Collection|Journal[] $journal
 * @property-read int|null $journal_count
 * @property-read Collection|Professor[] $professors
 * @property-read int|null $professors_count
 * @property-read Collection|Question[] $questions
 * @property-read int|null $questions_count
 * @property-read Collection|Result[] $results
 * @property-read int|null $results_count
 * @property-read Collection|Schedule[] $schedules
 * @property-read int|null $schedules_count
 *
 * @method static Builder|Course newModelQuery()
 * @method static Builder|Course newQuery()
 * @method static \Illuminate\Database\Query\Builder|Course onlyTrashed()
 * @method static Builder|Course query()
 * @method static Builder|Course whereCategoryId($value)
 * @method static Builder|Course whereCreatedAt($value)
 * @method static Builder|Course whereDeletedAt($value)
 * @method static Builder|Course whereDescription($value)
 * @method static Builder|Course whereId($value)
 * @method static Builder|Course whereImages($value)
 * @method static Builder|Course whereName($value)
 * @method static Builder|Course whereProfessorId($value)
 * @method static Builder|Course whereStatus($value)
 * @method static Builder|Course whereSubDescription($value)
 * @method static Builder|Course whereUpdatedAt($value)
 * @method static Builder|Course whereWeighting($value)
 * @method static \Illuminate\Database\Query\Builder|Course withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Course withoutTrashed()
 * @mixin \Eloquent
 *
 * @property int $institution_id
 *
 * @method static \Database\Factories\CourseFactory factory(...$parameters)
 * @method static Builder|Course whereInstitutionId($value)
 *
 * @property-read \App\Models\Institution $institution
 */
final class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }

    public function professors(): BelongsToMany
    {
        return $this->belongsToMany(Professor::class, 'professor_course');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercice::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }

    public function journal(): HasMany
    {
        return $this->hasMany(Journal::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function homeworks(): HasMany
    {
        return $this->hasMany(Homework::class);
    }

    public function ponderation(): string
    {
        return $this->weighting.' points ';
    }

    public function getImages(): string
    {
        return asset('storage/'.$this->images);
    }
}
