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
 * @property int $id
 * @property string $title
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Notification newModelQuery()
 * @method static Builder|Notification newQuery()
 * @method static Builder|Notification query()
 * @method static Builder|Notification whereContent($value)
 * @method static Builder|Notification whereCreatedAt($value)
 * @method static Builder|Notification whereId($value)
 * @method static Builder|Notification whereTitle($value)
 * @method static Builder|Notification whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Notification extends Model
{
    use HasFactory;

    protected $guarded = [];
}
