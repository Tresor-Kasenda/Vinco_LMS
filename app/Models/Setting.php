<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Setting.
 *
 * @property int $id
 * @property int $user_id
 * @property string $app_name
 * @property string|null $short_name
 * @property string|null $app_email
 * @property string|null $app_phone
 * @property string|null $app_address
 * @property string|null $app_icons
 * @property string|null $app_images
 * @property string|null $class_start
 * @property string|null $class_end
 * @property string|null $routine_time_difference
 * @property string|null $app_time_zone
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Query\Builder|Setting onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAppAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAppEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAppIcons($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAppImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAppName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAppPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereAppTimeZone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereClassEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereClassStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereRoutineTimeDifference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Setting withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Setting withoutTrashed()
 * @mixin \Eloquent
 */
class Setting extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
