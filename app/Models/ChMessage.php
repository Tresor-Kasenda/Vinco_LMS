<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\ChMessage
 *
 * @property int $id
 * @property string $type
 * @property int $from_id
 * @property int $to_id
 * @property string|null $body
 * @property string|null $attachment
 * @property int $seen
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|ChMessage newModelQuery()
 * @method static Builder|ChMessage newQuery()
 * @method static Builder|ChMessage query()
 * @method static Builder|ChMessage whereAttachment($value)
 * @method static Builder|ChMessage whereBody($value)
 * @method static Builder|ChMessage whereCreatedAt($value)
 * @method static Builder|ChMessage whereFromId($value)
 * @method static Builder|ChMessage whereId($value)
 * @method static Builder|ChMessage whereSeen($value)
 * @method static Builder|ChMessage whereToId($value)
 * @method static Builder|ChMessage whereType($value)
 * @method static Builder|ChMessage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ChMessage extends Model
{
    //
}
