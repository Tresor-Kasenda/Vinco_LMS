<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Journal
 *
 * @property int $id
 * @property int $course_id
 * @property int|null $student_id
 * @property int|null $professor_id
 * @property string $date
 * @property string $start_time
 * @property string $end_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $institution_id
 * @property-read Journal $course
 * @property-read \App\Models\Institution $institution
 * @property-read \App\Models\Student|null $student
 * @property-read \App\Models\Professor|null $teacher
 * @method static \Illuminate\Database\Eloquent\Builder|Journal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereInstitutionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereProfessorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Journal extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Journal::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Professor::class);
    }

}
