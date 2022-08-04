<?php

declare(strict_types=1);

namespace App\Models;

use DateTime;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Calendar.
 *
 * @property-read Event|null $institution
 *
 * @method static Builder|Calendar newModelQuery()
 * @method static Builder|Calendar newQuery()
 * @method static Builder|Calendar query()
 * @mixin Eloquent
 *
 * @property int $id
 * @property string $title
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property int $institution_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static \Database\Factories\CalendarFactory factory(...$parameters)
 * @method static Builder|Calendar whereCreatedAt($value)
 * @method static Builder|Calendar whereEndDate($value)
 * @method static Builder|Calendar whereId($value)
 * @method static Builder|Calendar whereInstitutionId($value)
 * @method static Builder|Calendar whereStartDate($value)
 * @method static Builder|Calendar whereTitle($value)
 * @method static Builder|Calendar whereUpdatedAt($value)
 */
class Calendar extends Model implements \MaddHatter\LaravelFullcalendar\Event
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'institution_id',
    ];

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
        return $this->belongsTo(Event::class);
    }
}
