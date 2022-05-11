<?php
declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Professor
 *
 * @property int $id
 * @property string $key
 * @property int $user_id
 * @property string $username
 * @property string $firstname
 * @property string $lastname
 * @property string $personnelEmail
 * @property string $phoneNumber
 * @property string $matriculate
 * @property string $country
 * @property string $images
 * @property string $location
 * @property string $identityCard
 * @property string $gender
 * @property string $birthdays
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $department_id
 * @property int $academic_year_id
 * @property-read \App\Models\Department $department
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Professor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Professor newQuery()
 * @method static \Illuminate\Database\Query\Builder|Professor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Professor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereAcademicYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereBirthdays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereIdentityCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereMatriculate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor wherePersonnelEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Professor whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|Professor withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Professor withoutTrashed()
 * @mixin \Eloquent
 */
class Professor extends Model
{
    use HasFactory, SoftDeletes, HasKeyTrait;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
