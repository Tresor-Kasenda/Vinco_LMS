<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\StudentFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * App\Models\Student.
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $department_id
 * @property int|null $subsidiary_id
 * @property int|null $promotion_id
 * @property string $name
 * @property string $firstname
 * @property string|null $lastname
 * @property string|null $email
 * @property string|null $phone_number
 * @property string|null $matriculate
 * @property string|null $images
 * @property string|null $nationality
 * @property string|null $location
 * @property string|null $identity_card
 * @property string|null $birthdays
 * @property string|null $born_city
 * @property string|null $born_town
 * @property string|null $parent_name
 * @property string|null $parent_phone
 * @property string $gender
 * @property string|null $address
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Department|null $department
 * @property-read Collection|Fee[] $fees
 * @property-read int|null $fees_count
 * @property-read Journal|null $journal
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Guardian $parent
 * @property-read Promotion|null $promotion
 * @property-read Collection|Result[] $results
 * @property-read int|null $results_count
 * @property-read Subsidiary|null $subsidiary
 * @property-read User $user
 * @method static Builder|Student newModelQuery()
 * @method static Builder|Student newQuery()
 * @method static \Illuminate\Database\Query\Builder|Student onlyTrashed()
 * @method static Builder|Student query()
 * @method static Builder|Student whereAddress($value)
 * @method static Builder|Student whereBirthdays($value)
 * @method static Builder|Student whereBornCity($value)
 * @method static Builder|Student whereBornTown($value)
 * @method static Builder|Student whereCreatedAt($value)
 * @method static Builder|Student whereDeletedAt($value)
 * @method static Builder|Student whereDepartmentId($value)
 * @method static Builder|Student whereEmail($value)
 * @method static Builder|Student whereFirstname($value)
 * @method static Builder|Student whereGender($value)
 * @method static Builder|Student whereId($value)
 * @method static Builder|Student whereIdentityCard($value)
 * @method static Builder|Student whereImages($value)
 * @method static Builder|Student whereLastname($value)
 * @method static Builder|Student whereLocation($value)
 * @method static Builder|Student whereMatriculate($value)
 * @method static Builder|Student whereName($value)
 * @method static Builder|Student whereNationality($value)
 * @method static Builder|Student whereParentName($value)
 * @method static Builder|Student whereParentPhone($value)
 * @method static Builder|Student wherePhoneNumber($value)
 * @method static Builder|Student wherePromotionId($value)
 * @method static Builder|Student whereStatus($value)
 * @method static Builder|Student whereSubsidiaryId($value)
 * @method static Builder|Student whereUpdatedAt($value)
 * @method static Builder|Student whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Student withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Student withoutTrashed()
 * @mixin \Eloquent
 * @property int|null $guardian_id
 * @property string|null $admission_date
 * @method static StudentFactory factory(...$parameters)
 * @method static Builder|Student whereAdmissionDate($value)
 * @method static Builder|Student whereGuardianId($value)
 */
final class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;

    protected $guarded = [];

    public function promotion(): BelongsTo
    {
        return $this->belongsTo(Promotion::class, 'promotion_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function subsidiary(): BelongsTo
    {
        return $this->belongsTo(Subsidiary::class, 'subsidiary_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fees(): HasMany
    {
        return $this->hasMany(Fee::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }

    public function journal(): HasOne
    {
        return $this->hasOne(Journal::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Guardian::class, 'guardian_id');
    }

    public function getImages(): string
    {
        return asset('storage/' . $this->images);
    }
}
