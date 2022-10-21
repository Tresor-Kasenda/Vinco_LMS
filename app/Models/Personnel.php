<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * App\Models\Personnel.
 *
 * @property int $id
 * @property int $user_id
 * @property string $username
 * @property string $matriculate
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string $email
 * @property string|null $phones
 * @property string|null $nationality
 * @property string|null $images_personnel
 * @property string|null $location
 * @property string|null $identityCard
 * @property string $gender
 * @property string|null $birthdays
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $academic_year_id
 * @property-read \App\Models\AcademicYear $academic
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\User $user
 *
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
 * @method static Builder|Personnel whereImagesPersonnel($value)
 * @method static Builder|Personnel whereLastname($value)
 * @method static Builder|Personnel whereLocation($value)
 * @method static Builder|Personnel whereMatriculate($value)
 * @method static Builder|Personnel whereNationality($value)
 * @method static Builder|Personnel wherePhones($value)
 * @method static Builder|Personnel whereUpdatedAt($value)
 * @method static Builder|Personnel whereUserId($value)
 * @method static Builder|Personnel whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|Personnel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Personnel withoutTrashed()
 * @mixin \Eloquent
 */
final class Personnel extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

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
