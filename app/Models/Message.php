<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Message
 *
 * @property-read string $date_time
 * @property-read \App\Models\Group|null $group
 * @property-read \App\Models\User $user
 * @method static Builder|Message newModelQuery()
 * @method static Builder|Message newQuery()
 * @method static Builder|Message query()
 * @mixin \Eloquent
 */
class Message extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function group(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Group', 'group_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function getDateTimeAttribute(): string
    {
        //we get the date and the time, this will return an array
        $dateAndTime = explode(' ', $this->created_at);

        $date = date('d-M-Y', strtotime($dateAndTime[0]));

        $time = date('H:i', strtotime($dateAndTime[1]));

        return "{$date} {$time}";
    }
}
