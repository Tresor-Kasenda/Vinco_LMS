<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RoomMessage
 *
 * @property-read \App\Models\Room|null $room
 * @method static \Illuminate\Database\Eloquent\Builder|RoomMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoomMessage query()
 * @mixin \Eloquent
 */
class RoomMessage extends Model
{
    use HasFactory;

    protected $fillable = ['message'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
