<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasPermissionTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * App\Models\User.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $status
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $active_status
 * @property string $avatar
 * @property int $dark_mode
 * @property string $messenger_color
 * @property-read Collection|Campus[] $campus
 * @property-read int|null $campus_count
 * @property-read Collection|Department[] $departments
 * @property-read int|null $departments_count
 * @property-read Collection|Group[] $group
 * @property-read int|null $group_count
 * @property-read Collection|Group[] $group_member
 * @property-read int|null $group_member_count
 * @property-read Institution|null $institution
 * @property-read Collection|Message[] $message
 * @property-read int|null $message_count
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|Guardian[] $parents
 * @property-read int|null $parents_count
 * @property-read Collection|Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read Personnel|null $personnel
 * @property-read Profile|null $profile
 * @property-read Collection|Role[] $roles
 * @property-read int|null $roles_count
 * @property-read Setting|null $setting
 * @property-read Collection|Student[] $students
 * @property-read int|null $students_count
 * @property-read Subsidiary|null $subsidiary
 * @property-read Professor|null $teacher
 * @property-read Collection|PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 *
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static Builder|User orWherePermissionIs($permission = '')
 * @method static Builder|User orWhereRoleIs($role = '', $team = null)
 * @method static Builder|User query()
 * @method static Builder|User whereActiveStatus($value)
 * @method static Builder|User whereAvatar($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDarkMode($value)
 * @method static Builder|User whereDeletedAt($value)
 * @method static Builder|User whereDoesntHavePermission()
 * @method static Builder|User whereDoesntHaveRole()
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereMessengerColor($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePermissionIs($permission = '', $boolean = 'and')
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereRoleIs($role = '', $team = null, $boolean = 'and')
 * @method static Builder|User whereStatus($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @mixin \Eloquent
 *
 * @property int|null $institution_id
 *
 * @method static Builder|User whereInstitutionId($value)
 */
final class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasPermissionTrait;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    public function personnel(): HasOne
    {
        return $this->hasOne(Personnel::class);
    }

    public function campus(): HasMany
    {
        return $this->hasMany(Campus::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function subsidiary(): HasOne
    {
        return $this->hasOne(Subsidiary::class);
    }

    public function teacher(): HasOne
    {
        return $this->hasOne(Professor::class);
    }

    public function setting(): HasOne
    {
        return $this->hasOne(Setting::class);
    }

    public function departments(): BelongsToMany
    {
        return $this
            ->belongsToMany(Department::class, 'user_department')
            ->withTimestamps();
    }

    public function parents(): HasMany
    {
        return $this->hasMany(Guardian::class);
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }

    public function group(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Group::class, 'admin_id');
    }

    public function group_member(): BelongsToMany
    {
        return $this->belongsToMany(
            Group::class,
            'group_participants',
            'user_id',
            'group_id'
        )
            ->orderBy('updated_at', 'desc');
    }

    public function message(): HasMany
    {
        return $this->hasMany(\App\Models\Message::class, 'user_id');
    }
}
