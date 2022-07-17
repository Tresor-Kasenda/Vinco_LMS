<?php

declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Institution
 *
 * @property-read Collection|\App\Models\Campus[] $campuses
 * @property-read int|null $campuses_count
 * @property-read Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read Collection|\App\Models\Event[] $events
 * @property-read int|null $events_count
 * @property-read Collection|\App\Models\Expense[] $expenses
 * @property-read int|null $expenses_count
 * @property-read Collection|\App\Models\Fee[] $fees
 * @property-read int|null $fees_count
 * @property-read \App\Models\Journal|null $journals
 * @property-read Collection|\App\Models\Professor[] $professors
 * @property-read int|null $professors_count
 * @property-read \App\Models\User|null $user
 * @method static Builder|Institution newModelQuery()
 * @method static Builder|Institution newQuery()
 * @method static \Illuminate\Database\Query\Builder|Institution onlyTrashed()
 * @method static Builder|Institution query()
 * @method static \Illuminate\Database\Query\Builder|Institution withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Institution withoutTrashed()
 * @mixin Eloquent
 */
class Institution extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function fees(): HasMany
    {
        return $this->hasMany(Fee::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function journals(): HasOne
    {
        return $this->hasOne(Journal::class);
    }

    public function campuses(): HasMany
    {
        return $this->hasMany(Campus::class);
    }

    public function professors(): HasMany
    {
        return $this->hasMany(Professor::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}
