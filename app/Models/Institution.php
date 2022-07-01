<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Institution
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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Campus[] $campuses
 * @property-read int|null $campuses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 * @property-read int|null $events_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Expense[] $expenses
 * @property-read int|null $expenses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Fee[] $fees
 * @property-read int|null $fees_count
 * @property-read \App\Models\Journal|null $journals
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Institution newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Institution newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Institution query()
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereInstitutionAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereInstitutionCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereInstitutionDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereInstitutionEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereInstitutionImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereInstitutionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereInstitutionPhones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereInstitutionRoutineTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereInstitutionStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereInstitutionTown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereInstitutionWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institution whereUserId($value)
 * @mixin \Eloquent
 */
class Institution extends Model
{
    use HasFactory;

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
