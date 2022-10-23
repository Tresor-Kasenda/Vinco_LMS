<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

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
 * @property string|null $app_time_zone
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Models\User $user
 *
 * @method static Builder|Setting newModelQuery()
 * @method static Builder|Setting newQuery()
 * @method static \Illuminate\Database\Query\Builder|Setting onlyTrashed()
 * @method static Builder|Setting query()
 * @method static Builder|Setting whereAppAddress($value)
 * @method static Builder|Setting whereAppEmail($value)
 * @method static Builder|Setting whereAppIcons($value)
 * @method static Builder|Setting whereAppImages($value)
 * @method static Builder|Setting whereAppName($value)
 * @method static Builder|Setting whereAppPhone($value)
 * @method static Builder|Setting whereAppTimeZone($value)
 * @method static Builder|Setting whereClassEnd($value)
 * @method static Builder|Setting whereClassStart($value)
 * @method static Builder|Setting whereCreatedAt($value)
 * @method static Builder|Setting whereDeletedAt($value)
 * @method static Builder|Setting whereId($value)
 * @method static Builder|Setting whereShortName($value)
 * @method static Builder|Setting whereUpdatedAt($value)
 * @method static Builder|Setting whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Setting withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Setting withoutTrashed()
 * @mixin \Eloquent
 */
final class Setting extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
