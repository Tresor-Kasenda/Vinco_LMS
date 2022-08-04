<?php

declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\ExamSession.
 *
 * @property int $id
 * @property string $name
 * @property string $start_date
 * @property string $end_date
 * @property string $note
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Exam[] $exam
 * @property-read int|null $exam_count
 *
 * @method static Builder|ExamSession newModelQuery()
 * @method static Builder|ExamSession newQuery()
 * @method static Builder|ExamSession query()
 * @method static Builder|ExamSession whereCreatedAt($value)
 * @method static Builder|ExamSession whereEndDate($value)
 * @method static Builder|ExamSession whereId($value)
 * @method static Builder|ExamSession whereName($value)
 * @method static Builder|ExamSession whereNote($value)
 * @method static Builder|ExamSession whereStartDate($value)
 * @method static Builder|ExamSession whereUpdatedAt($value)
 * @mixin Eloquent
 *
 * @method static \Database\Factories\ExamSessionFactory factory(...$parameters)
 */
class ExamSession extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function exam(): HasMany
    {
        return $this->hasMany(Exam::class);
    }
}
