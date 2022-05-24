<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasKeyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Lesson.
 *
 * @property int $id
 * @property string $key
 * @property int $chapter_id
 * @property string $name
 * @property string $shortContent
 * @property string|null $content
 * @property int|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Chapter $chapter
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Exercice[] $exercises
 * @property-read int|null $exercises_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Resource[] $resources
 * @property-read int|null $resources_count
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson newQuery()
 * @method static \Illuminate\Database\Query\Builder|Lesson onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereChapterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereShortContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Lesson withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Lesson withoutTrashed()
 * @mixin \Eloquent
 */
class Lesson extends Model
{
    use HasFactory, SoftDeletes, HasKeyTrait;

    protected $guarded = [];

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercice::class);
    }

    public function resources(): HasMany
    {
        return $this->hasMany(Resource::class);
    }
}
