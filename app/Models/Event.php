<?php

declare(strict_types=1);

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Event.
 *
 * @property int $id
 * @property string $title
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $institution_id
 * @property int|null $promotion_id
 * @property-read Event $institution
 * @property-read Promotion|null $promotion
 * @method static Builder|Event newModelQuery()
 * @method static Builder|Event newQuery()
 * @method static Builder|Event query()
 * @method static Builder|Event whereCreatedAt($value)
 * @method static Builder|Event whereEndDate($value)
 * @method static Builder|Event whereId($value)
 * @method static Builder|Event whereInstitutionId($value)
 * @method static Builder|Event wherePromotionId($value)
 * @method static Builder|Event whereStartDate($value)
 * @method static Builder|Event whereTitle($value)
 * @method static Builder|Event whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Event extends Model implements \MaddHatter\LaravelFullcalendar\Event
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['start_date', 'end_date'];

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function isAllDay(): bool
    {
        return (bool) $this->all_day;
    }

    public function getStart(): DateTime|Carbon
    {
        return $this->start_date;
    }

    public function getEnd(): DateTime|Carbon
    {
        return $this->end_date;
    }
    
    public function institution(): BelongsTo
    {
        return $this->belongsTo(self::class);
    }

    public function promotion(): BelongsTo
    {
        return $this->belongsTo(Promotion::class);
    }
}
