<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKeyTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Course.
 *
 * @property int $id
 * @property string $key
 * @property int $category_id
 * @property int $user_id
 * @property string $name
 * @property string $subDescription
 * @property string|null $description
 * @property string $duration
 * @property string $images
 * @property string $startDate
 * @property string $endDate
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $academic_year_id
 * @property-read Category $category
 * @property-read Collection|Chapter[] $chapters
 * @property-read int|null $chapters_count
 * @property-read Collection|Exam[] $exam
 * @property-read int|null $exam_count
 * @property-read Collection|Exercice[] $exercises
 * @property-read int|null $exercises_count
 * @property-read Collection|Question[] $questions
 * @property-read int|null $questions_count
 * @method static Builder|Course newModelQuery()
 * @method static Builder|Course newQuery()
 * @method static \Illuminate\Database\Query\Builder|Course onlyTrashed()
 * @method static Builder|Course query()
 * @method static Builder|Course whereAcademicYearId($value)
 * @method static Builder|Course whereCategoryId($value)
 * @method static Builder|Course whereCreatedAt($value)
 * @method static Builder|Course whereDeletedAt($value)
 * @method static Builder|Course whereDescription($value)
 * @method static Builder|Course whereDuration($value)
 * @method static Builder|Course whereEndDate($value)
 * @method static Builder|Course whereId($value)
 * @method static Builder|Course whereImages($value)
 * @method static Builder|Course whereKey($value)
 * @method static Builder|Course whereName($value)
 * @method static Builder|Course whereStartDate($value)
 * @method static Builder|Course whereStatus($value)
 * @method static Builder|Course whereSubDescription($value)
 * @method static Builder|Course whereUpdatedAt($value)
 * @method static Builder|Course whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Course withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Course withoutTrashed()
 * @mixin \Eloquent
 * @property-read User|null $user
 * @property string|null $start_date
 * @property string|null $end_date
 * @property int $professor_id
 * @property string|null $sub_description
 * @property int|null $weighting
 * @property-read Collection|\App\Models\Exam[] $exams
 * @property-read int|null $exams_count
 * @property-read Collection|\App\Models\Homework[] $homeworks
 * @property-read int|null $homeworks_count
 * @property-read Collection|\App\Models\Journal[] $journal
 * @property-read int|null $journal_count
 * @property-read Collection|\App\Models\Professor[] $professors
 * @property-read int|null $professors_count
 * @property-read Collection|\App\Models\Result[] $results
 * @property-read int|null $results_count
 * @property-read Collection|\App\Models\Schedule[] $schedules
 * @property-read int|null $schedules_count
 * @method static Builder|Course whereProfessorId($value)
 * @method static Builder|Course whereWeighting($value)
 */
class Course extends Model
{
    use HasFactory, SoftDeletes, HasKeyTrait;

    protected $guarded = [];

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }

    public function professors(): BelongsToMany
    {
        return $this->belongsToMany(Professor::class);
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
}
