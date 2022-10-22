<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Lesson.
 *
 * @property int $id
 * @property int $chapter_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Chapter $chapter
 * @property-read Collection|\App\Models\Exercice[] $exercises
 * @property-read int|null $exercises_count
 * @property string|null $end_time
 * @property-read Collection|\App\Models\Homework[] $homeworks
 * @property-read int|null $homeworks_count
 * @property-read Collection|\App\Models\Resource[] $resources
 * @property-read int|null $resources_count
 * @property-write mixed $start_time
 * @property-read \App\Models\LessonType|null $type
 * @method static Builder|Lesson calendarByRoleOrClassId()
 * @method static Builder|Lesson newModelQuery()
 * @method static Builder|Lesson newQuery()
 * @method static \Illuminate\Database\Query\Builder|Lesson onlyTrashed()
 * @method static Builder|Lesson query()
 * @method static Builder|Lesson whereChapterId($value)
 * @method static Builder|Lesson whereCreatedAt($value)
 * @method static Builder|Lesson whereDeletedAt($value)
 * @method static Builder|Lesson whereId($value)
 * @method static Builder|Lesson whereName($value)
 * @method static Builder|Lesson whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Lesson withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Lesson withoutTrashed()
 * @mixin Eloquent
 * @property int|null $lesson_type_id
 * @property string|null $content
 * @method static Builder|Lesson whereContent($value)
 * @method static Builder|Lesson whereLessonTypeId($value)
 * @property int $institution_id
 * @method static Builder|Lesson whereInstitutionId($value)
 * @property string|null $description
 * @property string|null $file
 * @method static Builder|Lesson whereDescription($value)
 * @method static Builder|Lesson whereFile($value)
 */
final class Lesson extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const WEEK_DAYS = [
        '1' => 'Monday',
        '2' => 'Tuesday',
        '3' => 'Wednesday',
        '4' => 'Thursday',
        '5' => 'Friday',
        '6' => 'Saturday',
        '7' => 'Sunday',
    ];

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function isTimeAvailable($weekday, $startTime, $endTime, $class, $teacher, $lesson): bool
    {
        $lessons = self::where('weekday', $weekday)
            ->when($lesson, function ($query) use ($lesson) {
                $query->where('id', '!=', $lesson);
            })
            ->where(function ($query) use ($class, $teacher) {
                $query->where('class_id', $class)
                    ->orWhere('teacher_id', $teacher);
            })
            ->where([
                ['start_time', '<', $endTime],
                ['end_time', '>', $startTime],
            ])
            ->count();

        return ! $lessons;
    }

    public function getDifference(): int
    {
        return Carbon::parse($this->end_time)->diffInMinutes($this->start_time);
    }

    public function getStartTime($value): ?string
    {
        return $value ? Carbon::createFromFormat('H:i:s', $value)
            ->format(config('panel.lesson_time_format')) : null;
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = $value ? Carbon::createFromFormat(
            config('panel.lesson_time_format'),
            $value
        )->format('H:i:s') : null;
    }

    public function getEndTimeAttribute($value): ?string
    {
        return $value ? Carbon::createFromFormat('H:i:s', $value)
            ->format(config('panel.lesson_time_format')) : null;
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = $value ? Carbon::createFromFormat(
            config('panel.lesson_time_format'),
            $value
        )->format('H:i:s') : null;
    }

    public function scopeCalendarByRoleOrClassId($query)
    {
        return $query->when(! request()->input('class_id'), function ($query) {
            $query->when(auth()->user()->is_teacher, function ($query) {
                $query->where('teacher_id', auth()->user()->id);
            })
                ->when(auth()->user()->is_student, function ($query) {
                    $query->where('class_id', auth()->user()->class_id ?? '0');
                });
        })
            ->when(request()->input('class_id'), function ($query) {
                $query->where('class_id', request()->input('class_id'));
            });
    }

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercice::class);
    }

    public function resources(): HasMany
    {
        return $this->hasMany(Resource::class);
    }

    public function homeworks(): HasMany
    {
        return $this->hasMany(Homework::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(LessonType::class);
    }
}
