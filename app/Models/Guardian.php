<?php

declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * App\Models\Guardian
 *
 * @property int $id
 * @property int $user_id
 * @property string $name_guardian
 * @property string|null $firstName_guardian
 * @property string $email_guardian
 * @property string $gender
 * @property string|null $images
 * @property string $phones
 * @property string|null $occupation
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|\App\Models\Fee[] $fees
 * @property-read int|null $fees_count
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|\App\Models\Student[] $students
 * @property-read int|null $students_count
 * @property-read \App\Models\User $user
 * @method static Builder|Guardian newModelQuery()
 * @method static Builder|Guardian newQuery()
 * @method static Builder|Guardian query()
 * @method static Builder|Guardian whereCreatedAt($value)
 * @method static Builder|Guardian whereEmailGuardian($value)
 * @method static Builder|Guardian whereFirstNameGuardian($value)
 * @method static Builder|Guardian whereGender($value)
 * @method static Builder|Guardian whereId($value)
 * @method static Builder|Guardian whereImages($value)
 * @method static Builder|Guardian whereNameGuardian($value)
 * @method static Builder|Guardian whereOccupation($value)
 * @method static Builder|Guardian wherePhones($value)
 * @method static Builder|Guardian whereUpdatedAt($value)
 * @method static Builder|Guardian whereUserId($value)
 * @mixin Eloquent
 */
final class Guardian extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fees(): HasMany
    {
        return $this->hasMany(Fee::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
