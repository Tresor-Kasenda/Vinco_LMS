<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\ExpenseType
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property string $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|ExpenseType newModelQuery()
 * @method static Builder|ExpenseType newQuery()
 * @method static Builder|ExpenseType query()
 * @method static Builder|ExpenseType whereCreatedAt($value)
 * @method static Builder|ExpenseType whereId($value)
 * @method static Builder|ExpenseType whereImage($value)
 * @method static Builder|ExpenseType whereKey($value)
 * @method static Builder|ExpenseType whereName($value)
 * @method static Builder|ExpenseType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ExpenseType extends Model
{
    use HasFactory;
}
