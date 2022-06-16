<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Result
 *
 * @property int $id
 * @property string $key
 * @property int $course_id
 * @property int $student_id
 * @property string $cote
 * @property string $observation
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Result newModelQuery()
 * @method static Builder|Result newQuery()
 * @method static Builder|Result query()
 * @method static Builder|Result whereCote($value)
 * @method static Builder|Result whereCourseId($value)
 * @method static Builder|Result whereCreatedAt($value)
 * @method static Builder|Result whereId($value)
 * @method static Builder|Result whereKey($value)
 * @method static Builder|Result whereObservation($value)
 * @method static Builder|Result whereStatus($value)
 * @method static Builder|Result whereStudentId($value)
 * @method static Builder|Result whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Result extends Model
{
    use HasFactory;
}
