<?php

declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * App\Models\Professor
 *
 * @property int $id
 * @property int $user_id
 * @property string $username
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $email
 * @property string|null $phones
 * @property string $matriculate
 * @property string|null $country
 * @property string|null $images
 * @property string|null $location
 * @property string|null $identityCard
 * @property string $gender
 * @property string|null $birthdays
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection|\App\Models\Course[] $courses
 * @property-read int|null $courses_count
 * @property-read \App\Models\Institution|null $institution
 * @property-read Collection|\App\Models\Journal[] $journals
 * @property-read int|null $journals_count
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\User $user
 * @method static Builder|Professor newModelQuery()
 * @method static Builder|Professor newQuery()
 * @method static \Illuminate\Database\Query\Builder|Professor onlyTrashed()
 * @method static Builder|Professor query()
 * @method static Builder|Professor whereBirthdays($value)
 * @method static Builder|Professor whereCountry($value)
 * @method static Builder|Professor whereCreatedAt($value)
 * @method static Builder|Professor whereDeletedAt($value)
 * @method static Builder|Professor whereEmail($value)
 * @method static Builder|Professor whereFirstname($value)
 * @method static Builder|Professor whereGender($value)
 * @method static Builder|Professor whereId($value)
 * @method static Builder|Professor whereIdentityCard($value)
 * @method static Builder|Professor whereImages($value)
 * @method static Builder|Professor whereLastname($value)
 * @method static Builder|Professor whereLocation($value)
 * @method static Builder|Professor whereMatriculate($value)
 * @method static Builder|Professor wherePhones($value)
 * @method static Builder|Professor whereUpdatedAt($value)
 * @method static Builder|Professor whereUserId($value)
 * @method static Builder|Professor whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|Professor withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Professor withoutTrashed()
 * @mixin Eloquent
 */
class Professor extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'professor_course');
    }

    public function journals(): HasMany
    {
        return $this->hasMany(Journal::class);
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }
}
