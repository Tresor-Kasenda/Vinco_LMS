<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $academic_year_id
 * @property-read \App\Models\Department|null $department
 * @property-read \App\Models\Promotion|null $promotion
 * @property-read \App\Models\Subsidiary|null $subsidiary
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student newQuery()
 * @method static \Illuminate\Database\Query\Builder|Student onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Student query()
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereAcademicYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereBirthdays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereBornCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereBornTown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereIdentityCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereMatriculate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereMiddlename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student wherePromotionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereResponsibleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereResponsiblePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereSubsidiaryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Student withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Student withoutTrashed()
 * @mixin \Eloquent
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
}
