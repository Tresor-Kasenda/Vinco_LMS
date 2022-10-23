<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Notification.
 *
 * @method static Builder|Notification newModelQuery()
 * @method static Builder|Notification newQuery()
 * @method static Builder|Notification query()
 * @mixin \Eloquent
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Notification whereContent($value)
 * @method static Builder|Notification whereCreatedAt($value)
 * @method static Builder|Notification whereId($value)
 * @method static Builder|Notification whereTitle($value)
 * @method static Builder|Notification whereUpdatedAt($value)
 *
 * @property string $type
 * @property string $notifiable_type
 * @property int $notifiable_id
 * @property string $data
 * @property string|null $read_at
 *
 * @method static Builder|Notification whereData($value)
 * @method static Builder|Notification whereNotifiableId($value)
 * @method static Builder|Notification whereNotifiableType($value)
 * @method static Builder|Notification whereReadAt($value)
 * @method static Builder|Notification whereType($value)
 */
final class Notification extends Model
{
    use HasFactory;

    protected $guarded = [];
}
