<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Journal
 *
 * @property-read Journal $course
 * @property-read \App\Models\Institution|null $institution
 * @property-read \App\Models\Student $student
 * @property-read \App\Models\Professor|null $teacher
 * @method static Builder|Journal newModelQuery()
 * @method static Builder|Journal newQuery()
 * @method static Builder|Journal query()
 * @mixin \Eloquent
 */
class Journal extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'course_id',
        'student_id',
        'professor_id',
        'title',
        'start_time',
        'end_time',
    ];

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(self::class);
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
