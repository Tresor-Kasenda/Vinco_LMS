<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\FeeType
 *
 * @property int $id
 * @property string $name
 * @property string $images
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|\App\Models\Fee[] $feeType
 * @property-read int|null $fee_type_count
 *
 * @method static Builder|FeeType newModelQuery()
 * @method static Builder|FeeType newQuery()
 * @method static Builder|FeeType query()
 * @method static Builder|FeeType whereCreatedAt($value)
 * @method static Builder|FeeType whereId($value)
 * @method static Builder|FeeType whereImages($value)
 * @method static Builder|FeeType whereName($value)
 * @method static Builder|FeeType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
final class FeeType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function feeType(): HasMany
    {
        return $this->hasMany(Fee::class);
    }
}
