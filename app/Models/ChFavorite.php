<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\ChFavorite
 *
 * @property int $id
 * @property int $user_id
 * @property int $favorite_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|ChFavorite newModelQuery()
 * @method static Builder|ChFavorite newQuery()
 * @method static Builder|ChFavorite query()
 * @method static Builder|ChFavorite whereCreatedAt($value)
 * @method static Builder|ChFavorite whereFavoriteId($value)
 * @method static Builder|ChFavorite whereId($value)
 * @method static Builder|ChFavorite whereUpdatedAt($value)
 * @method static Builder|ChFavorite whereUserId($value)
 * @mixin \Eloquent
 */
final class ChFavorite extends Model
{
    //
}
