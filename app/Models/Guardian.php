<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Guardian
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
 * @mixin \Eloquent
 */
class Guardian extends Model
{
    use HasFactory;
}
