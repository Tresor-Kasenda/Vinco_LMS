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
 * App\Models\Event
 *
 * @property-read Event|null $institution
 * @property-read \App\Models\Promotion|null $promotion
 * @method static Builder|Event newModelQuery()
 * @method static Builder|Event newQuery()
 * @method static Builder|Event query()
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
