<?php

declare(strict_types=1);

namespace App\Models;

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
 * App\Models\Institution.
 *
 * @property int $id
 * @property int $user_id
 * @property string $institution_name
 * @property string|null $institution_country
 * @property string|null $institution_town
 * @property string|null $institution_address
 * @property string|null $institution_phones
 * @property string|null $institution_website
 * @property string|null $institution_images
 * @property string|null $institution_start_time
 * @property string|null $institution_end_time
 * @property int|null $institution_routine_time
 * @property string|null $institution_description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection|Campus[] $campuses
 * @property-read int|null $campuses_count
 * @property-read Collection|Event[] $events
 * @property-read int|null $events_count
 * @property-read Collection|Expense[] $expenses
 * @property-read int|null $expenses_count
 * @property-read Collection|Fee[] $fees
 * @property-read int|null $fees_count
 * @property-read Journal|null $journals
 * @property-read User $user
 * @method static Builder|Institution newModelQuery()
 * @method static Builder|Institution newQuery()
 * @method static \Illuminate\Database\Query\Builder|Institution onlyTrashed()
 * @method static Builder|Institution query()
 * @method static Builder|Institution whereCreatedAt($value)
 * @method static Builder|Institution whereDeletedAt($value)
 * @method static Builder|Institution whereId($value)
 * @method static Builder|Institution whereInstitutionAddress($value)
 * @method static Builder|Institution whereInstitutionCountry($value)
 * @method static Builder|Institution whereInstitutionDescription($value)
 * @method static Builder|Institution whereInstitutionEndTime($value)
 * @method static Builder|Institution whereInstitutionImages($value)
 * @method static Builder|Institution whereInstitutionName($value)
 * @method static Builder|Institution whereInstitutionPhones($value)
 * @method static Builder|Institution whereInstitutionRoutineTime($value)
 * @method static Builder|Institution whereInstitutionStartTime($value)
 * @method static Builder|Institution whereInstitutionTown($value)
 * @method static Builder|Institution whereInstitutionWebsite($value)
 * @method static Builder|Institution whereUpdatedAt($value)
 * @method static Builder|Institution whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Institution withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Institution withoutTrashed()
 * @mixin \Eloquent
 */
class Institution extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
}
