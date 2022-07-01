<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Fee.
 *
 * @property int $id
 * @property int $fee_type_id
 * @property int $student_id
 * @property string $transaction_no
 * @property string $amount
 * @property string $due_date
 * @property string $pay_date
 * @property string $status
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read FeeType $feeType
 * @property-read Student $student
 * @method static Builder|Fee newModelQuery()
 * @method static Builder|Fee newQuery()
 * @method static Builder|Fee query()
 * @method static Builder|Fee whereAmount($value)
 * @method static Builder|Fee whereCreatedAt($value)
 * @method static Builder|Fee whereDescription($value)
 * @method static Builder|Fee whereDueDate($value)
 * @method static Builder|Fee whereFeeTypeId($value)
 * @method static Builder|Fee whereId($value)
 * @method static Builder|Fee wherePayDate($value)
 * @method static Builder|Fee whereStatus($value)
 * @method static Builder|Fee whereStudentId($value)
 * @method static Builder|Fee whereTransactionNo($value)
 * @method static Builder|Fee whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $guardian_id
 * @method static Builder|Fee whereGuardianId($value)
 * @property int $institution_id
 * @property-read \App\Models\Institution $institution
 * @property-read \App\Models\Guardian|null $parent
 * @method static Builder|Fee whereInstitutionId($value)
 */
class Fee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function feeType(): BelongsTo
    {
        return $this->belongsTo(FeeType::class, 'fee_type_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Guardian::class);
    }
}
