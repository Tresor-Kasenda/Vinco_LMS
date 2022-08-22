<?php

declare(strict_types=1);

namespace App\Models;

use App\States\EnableState\ActivateRoomState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStates\HasStates;

/**
 * App\Models\Live.
 *
 * @property int $id
 * @property int|null $lesson_id
 * @property int $user_id
 * @property string $room_id
 * @property string $room_name
 * @property string $reference
 * @property string $schedule
 * @property int $participants
 * @property string $duration
 * @property mixed $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Lesson|null $lesson
 * @property-read \App\Models\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Live newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Live newQuery()
 * @method static \Illuminate\Database\Query\Builder|Live onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Live orWhereNotState(string $column, $states)
 * @method static \Illuminate\Database\Eloquent\Builder|Live orWhereState(string $column, $states)
 * @method static \Illuminate\Database\Eloquent\Builder|Live query()
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereLessonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereNotState(string $column, $states)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereParticipants($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereRoomName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereSchedule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereState(string $column, $states)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Live whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Live withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Live withoutTrashed()
 * @mixin \Eloquent
 */
final class Live extends Model
{
    use HasFactory, SoftDeletes, HasStates;

    protected $guarded = [];

    protected $casts = [
        'status' => ActivateRoomState::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
