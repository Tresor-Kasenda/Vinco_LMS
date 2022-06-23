<?php

namespace App\Models;

use App\Traits\HasKeyTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Expense.
 *
 * @property int $id
 * @property string $key
 * @property string $amount
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $expense_type_id
 * @method static Builder|Expense newModelQuery()
 * @method static Builder|Expense newQuery()
 * @method static Builder|Expense query()
 * @method static Builder|Expense whereAmount($value)
 * @method static Builder|Expense whereCreatedAt($value)
 * @method static Builder|Expense whereDescription($value)
 * @method static Builder|Expense whereExpenseTypeId($value)
 * @method static Builder|Expense whereId($value)
 * @method static Builder|Expense whereKey($value)
 * @method static Builder|Expense whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read ExpenseType $types
 */
class Expense extends Model
{
    use HasFactory, HasKeyTrait;

    protected $guarded = [];

    public function types(): BelongsTo
    {
        return $this->belongsTo(ExpenseType::class, 'expense_type_id');
    }
}
