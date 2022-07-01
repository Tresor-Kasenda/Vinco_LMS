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
 * App\Models\Personnel.
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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $academic_year_id
 * @property-read AcademicYear $academic
 * @property-read User $user
 * @method static Builder|Personnel newModelQuery()
 * @method static Builder|Personnel newQuery()
 * @method static \Illuminate\Database\Query\Builder|Personnel onlyTrashed()
 * @method static Builder|Personnel query()
 * @method static Builder|Personnel whereAcademicYearId($value)
 * @method static Builder|Personnel whereBirthdays($value)
 * @method static Builder|Personnel whereCreatedAt($value)
 * @method static Builder|Personnel whereDeletedAt($value)
 * @method static Builder|Personnel whereEmail($value)
 * @method static Builder|Personnel whereFirstname($value)
 * @method static Builder|Personnel whereGender($value)
 * @method static Builder|Personnel whereId($value)
 * @method static Builder|Personnel whereIdentityCard($value)
 * @method static Builder|Personnel whereImages($value)
 * @method static Builder|Personnel whereKey($value)
 * @method static Builder|Personnel whereLastname($value)
 * @method static Builder|Personnel whereLocation($value)
 * @method static Builder|Personnel whereMatriculate($value)
 * @method static Builder|Personnel whereNationality($value)
 * @method static Builder|Personnel wherePhones($value)
 * @method static Builder|Personnel whereStatus($value)
 * @method static Builder|Personnel whereUpdatedAt($value)
 * @method static Builder|Personnel whereUserId($value)
 * @method static Builder|Personnel whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|Personnel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Personnel withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $images_personnel
 * @method static Builder|Personnel whereImagesPersonnel($value)
 */
class Personnel extends Model
{
    use HasFactory, SoftDeletes, HasKeyTrait;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function academic(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }
}
