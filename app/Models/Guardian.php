<?php

namespace App\Models;

use App\Traits\HasKeyTrait;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Guardian.
 *
 * @property int $id
 * @property string $key
 * @property int $user_id
 * @property string $gender
 * @property string $image
 * @property string $phones
 * @property string|null $occupation
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Guardian newModelQuery()
 * @method static Builder|Guardian newQuery()
 * @method static Builder|Guardian query()
 * @method static Builder|Guardian whereCreatedAt($value)
 * @method static Builder|Guardian whereGender($value)
 * @method static Builder|Guardian whereId($value)
 * @method static Builder|Guardian whereImage($value)
 * @method static Builder|Guardian whereKey($value)
 * @method static Builder|Guardian whereOccupation($value)
 * @method static Builder|Guardian wherePhones($value)
 * @method static Builder|Guardian whereUpdatedAt($value)
 * @method static Builder|Guardian whereUserId($value)
 * @mixin Eloquent
 * @property string $name_guardian
 * @property string|null $firstName_guardian
 * @property string $email_guardian
 * @property string $images
 * @method static Builder|Guardian whereEmailGuardian($value)
 * @method static Builder|Guardian whereFirstNameGuardian($value)
 * @method static Builder|Guardian whereImages($value)
 * @method static Builder|Guardian whereNameGuardian($value)
 * @property-read User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Fee[] $fees
 * @property-read int|null $fees_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $students
 * @property-read int|null $students_count
 */
class Guardian extends Model
{
    use HasFactory, HasKeyTrait;

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
