<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Result.
 *
 * @property int $id
 * @property int $course_id
 * @property int $student_id
 * @property string $cote
 * @property string $observation
 * @property int|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Course $course
 * @property-read Student $student
 * @method static Builder|Result newModelQuery()
 * @method static Builder|Result newQuery()
 * @method static Builder|Result query()
 * @method static Builder|Result whereCote($value)
 * @method static Builder|Result whereCourseId($value)
 * @method static Builder|Result whereCreatedAt($value)
 * @method static Builder|Result whereId($value)
 * @method static Builder|Result whereObservation($value)
 * @method static Builder|Result whereStatus($value)
 * @method static Builder|Result whereStudentId($value)
 * @method static Builder|Result whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $institution_id
 * @property-read \App\Models\Institution $institution
 * @method static Builder|Result whereInstitutionId($value)
 */
/**
 * App\Models\Result.
 *
 * @property int $id
 * @property int $course_id
 * @property int $student_id
 * @property string $cote
 * @property string $observation
 * @property int|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Course $course
 * @property-read Student $student
 *
 * @method static Builder|Result newModelQuery()
 * @method static Builder|Result newQuery()
 * @method static Builder|Result query()
 * @method static Builder|Result whereCote($value)
 * @method static Builder|Result whereCourseId($value)
 * @method static Builder|Result whereCreatedAt($value)
 * @method static Builder|Result whereId($value)
 * @method static Builder|Result whereObservation($value)
 * @method static Builder|Result whereStatus($value)
 * @method static Builder|Result whereStudentId($value)
 * @method static Builder|Result whereUpdatedAt($value)
 * @mixin \Eloquent
 */
final class Result extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }
}
