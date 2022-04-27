<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class,'role_id');
    }

    public function personnel(): HasOne
    {
        return $this->hasOne(Personnel::class);
    }

    public function campus(): HasOne
    {
        return $this->hasOne(Campus::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function subsidiary(): HasOne
    {
        return $this->hasOne(Subsidiary::class);
    }

    public function professors(): HasMany
    {
        return $this->hasMany(Professor::class);
    }

    public function users(): BelongsToMany
    {
        return $this
            ->belongsToMany(Department::class, 'user_department')
            ->withTimestamps();
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
