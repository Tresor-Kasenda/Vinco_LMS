<?php
declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKeyTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $department_id
 * @property int $academic_year_id
 * @property-read Department $department
 * @property-read User $user
 * @method static Builder|Professor newModelQuery()
 * @method static Builder|Professor newQuery()
 * @method static \Illuminate\Database\Query\Builder|Professor onlyTrashed()
 * @method static Builder|Professor query()
 * @method static Builder|Professor whereAcademicYearId($value)
 * @method static Builder|Professor whereBirthdays($value)
 * @method static Builder|Professor whereCountry($value)
 * @method static Builder|Professor whereCreatedAt($value)
 * @method static Builder|Professor whereDeletedAt($value)
 * @method static Builder|Professor whereDepartmentId($value)
 * @method static Builder|Professor whereFirstname($value)
 * @method static Builder|Professor whereGender($value)
 * @method static Builder|Professor whereId($value)
 * @method static Builder|Professor whereIdentityCard($value)
 * @method static Builder|Professor whereImages($value)
 * @method static Builder|Professor whereKey($value)
 * @method static Builder|Professor whereLastname($value)
 * @method static Builder|Professor whereLocation($value)
 * @method static Builder|Professor whereMatriculate($value)
 * @method static Builder|Professor wherePersonnelEmail($value)
 * @method static Builder|Professor wherePhoneNumber($value)
 * @method static Builder|Professor whereStatus($value)
 * @method static Builder|Professor whereUpdatedAt($value)
 * @method static Builder|Professor whereUserId($value)
 * @method static Builder|Professor whereUsername($value)
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
