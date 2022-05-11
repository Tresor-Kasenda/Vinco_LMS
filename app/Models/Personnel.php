<?php
declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Personnel
 *
 * @property int $id
 * @property string $key
 * @property int $user_id
 * @property string $username
 * @property string $matriculate
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $phones
 * @property string $nationality
 * @property string $images
 * @property string $location
 * @property string $identityCard
 * @property string $gender
 * @property string $birthdays
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $academic_year_id
 * @property-read \App\Models\AcademicYear $academic
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel newQuery()
 * @method static \Illuminate\Database\Query\Builder|Personnel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel query()
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereAcademicYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereBirthdays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereIdentityCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereMatriculate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel wherePhones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Personnel whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|Personnel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Personnel withoutTrashed()
 * @mixin \Eloquent
 */
class Personnel extends Model
{
    use HasFactory, SoftDeletes, HasKeyTrait;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function academic(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }
}
