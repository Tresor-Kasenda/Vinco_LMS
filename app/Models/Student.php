<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKeyTrait;
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
 * App\Models\Student.
 *
 * @property int $id
 * @property string $key
 * @property int $user_id
 * @property int|null $promotion_id
 * @property int|null $department_id
 * @property int|null $subsidiary_id
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property string $email
 * @property string $phoneNumber
 * @property string $matriculate
 * @property string $images
 * @property string $nationality
 * @property string $location
 * @property string $identityCard
 * @property string $birthdays
 * @property string $bornCity
 * @property string $bornTown
 * @property string $responsibleName
 * @property string $responsiblePhone
 * @property string $gender
 * @property string $address
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $academic_year_id
 * @property-read Department|null $department
 * @property-read Promotion|null $promotion
 * @property-read Subsidiary|null $subsidiary
 * @property-read User|null $user
 * @method static Builder|Student newModelQuery()
 * @method static Builder|Student newQuery()
 * @method static \Illuminate\Database\Query\Builder|Student onlyTrashed()
 * @method static Builder|Student query()
 * @method static Builder|Student whereAcademicYearId($value)
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
 * @method static Builder|Student whereKey($value)
 * @method static Builder|Student whereLastname($value)
 * @method static Builder|Student whereLocation($value)
 * @method static Builder|Student whereMatriculate($value)
 * @method static Builder|Student whereMiddlename($value)
 * @method static Builder|Student whereNationality($value)
 * @method static Builder|Student wherePhoneNumber($value)
 * @method static Builder|Student wherePromotionId($value)
 * @method static Builder|Student whereResponsibleName($value)
 * @method static Builder|Student whereResponsiblePhone($value)
 * @method static Builder|Student whereStatus($value)
 * @method static Builder|Student whereSubsidiaryId($value)
 * @method static Builder|Student whereUpdatedAt($value)
 * @method static Builder|Student whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Student withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Student withoutTrashed()
 * @mixin \Eloquent
 * @property-read Collection|Fee[] $fees
 * @property-read int|null $fees_count
 * @property string|null $phone_number
 * @property string|null $identity_card
 * @property string|null $born_city
 * @property string|null $parent_name
 * @property string|null $parent_phone
 * @property int $guardian_id
 * @property string|null $admission
 * @method static Builder|Student whereAdmission($value)
 * @method static Builder|Student whereGuardianId($value)
 * @method static Builder|Student whereParentName($value)
 * @method static Builder|Student whereParentPhone($value)
 * @property string $name
 * @property string|null $born_town
 * @property string|null $admission_date
 * @property-read \App\Models\Journal|null $journal
 * @property-read \App\Models\Guardian|null $parent
 * @property-read Collection|\App\Models\Result[] $results
 * @property-read int|null $results_count
 * @method static Builder|Student whereAdmissionDate($value)
 * @method static Builder|Student whereName($value)
 */
class Student extends Model
{
    use HasFactory, SoftDeletes, HasKeyTrait;

    protected $guarded = [];

    public function promotion(): BelongsTo
    {
        return $this->belongsTo(Promotion::class, 'promotion');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'promotion');
    }

    public function subsidiary(): BelongsTo
    {
        return $this->belongsTo(Subsidiary::class, 'promotion');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'promotion');
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
        return $this->belongsTo(Guardian::class);
    }
}
