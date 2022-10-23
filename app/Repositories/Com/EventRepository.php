<?php

declare(strict_types=1);

namespace App\Repositories\Com;

use App\Contracts\EventRepositoryInterface;
use App\Models\Event as EventModel;
use Auth;
use Calendar;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

final class EventRepository implements EventRepositoryInterface
{
    /**
     * @throws Exception
     */
    public function events(): \MaddHatter\LaravelFullcalendar\Calendar
    {
        $events = EventModel::query()
            ->orderByDesc('created_at')
            ->get();
        $calendar = [];

        foreach ($events as $event) {
            $calendar[] = Calendar::event(
                ucfirst((string) $event->title),
                true,
                new $event->start_date(),
                new $event->end_date(),
                $event->id
            );
        }

        return \Calendar::addEvents($calendar, ['color' => '#800'])
            ->setOptions([
                'locale' => 'fr',
                'firstDay' => 0,
                'displayEventTime' => true,
                'selectable' => true,
                'initialView' => 'timeGridWeek',
                'headerToolbar' => [
                    'end' => 'today prev,next dayGridMonth timeGridWeek timeGridDay',
                ],
            ])
            ->setCallbacks([
                'select' => 'function(selectionInfo){}',
                'eventClick' => 'function(event){}',
            ]);
    }

    public function showEvent(string $key): Model|EventModel|Builder
    {
        return EventModel::query()
            ->where('id', '=', $key)
            ->firstOrFail();
    }

    public function stored($attributes, $factory): Model|EventModel|Builder
    {
        $event = EventModel::query()
            ->create([
                'title' => $attributes->input('title'),
                'start_date' => $attributes->input('start_date'),
                'end_date' => $attributes->input('end_date'),
                'institution_id' => Auth::user()->institution_id,
            ]);

        $factory->addSuccess('Event added with successfully');

        return $event;
    }

    public function updated(string $key, $attributes, $factory): Model|EventModel|Builder
    {
        $event = $this->showEvent($key);
        $event->update([
            'title' => $attributes->input('title'),
            'start_date' => $attributes->input('start_date'),
            'end_date' => $attributes->input('end_date'),
            'institution_id' => Auth::user()->institution_id,
        ]);

        $factory->addSuccess('Event modified with successfully');

        return $event;
    }

    public function deleted(string $key, $factory): Model|EventModel|Builder
    {
        $event = $this->showEvent($key);

        $event->delete();

        return $event;
    }
}
