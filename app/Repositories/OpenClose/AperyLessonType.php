<?php

declare(strict_types=1);

namespace App\Repositories\OpenClose;

use App\Contracts\LessonTypeInterface;
use App\Http\Requests\LessonRequest;
use App\Http\Requests\LessonUpdateRequest;
use App\Jobs\RoomNotification;
use App\Jobs\StudentNotificationRoom;
use App\Models\Live;
use App\Services\EnableX\EnableXService;
use App\States\EnableState\Pending;
use App\Traits\RandomValue;
use App\Traits\TimeCalculation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

final class AperyLessonType implements LessonTypeInterface
{
    use RandomValue;
    use TimeCalculation;

    /**
     * @throws \Exception
     */
    public function store(LessonRequest $attributes, $lesson): Model|Live|Builder
    {
        $rooms = self::create(attributes: $attributes);
        $currentTime = strtotime(''.$attributes->input('date').' '.$attributes->input('start_time').'');
        $date = date('Y-m-d H:i:s', $currentTime);
        $pinCode = random_int(100000, 999999);
        $participant = $this->generateStringValues(0, 9999);
        $guests = $attributes->input('participants');

        RoomNotification::dispatch(
            $pinCode,
            $rooms,
            $date,
            $attributes
        )
            ->delay(now()->addSecond());

        foreach ($guests as $guest) {
            StudentNotificationRoom::dispatch(
                $participant,
                $rooms,
                $date,
                $guest,
                $attributes
            )
                ->delay(now()->addSecond());
        }

        return Live::query()
            ->create([
                'lesson_id' => $lesson->id,
                'room_id' => $attributes->input(''),
                'room_name' => $lesson->name,
                'duration' => $attributes->input(''),
                'participants' => $attributes->input('participants'),
                'schedule' => $attributes->input('date'),
                'reference' => $attributes->input(''),
                'status' => Pending::class,
            ]);
    }

    private static function create($attributes)
    {
        [$date, $difference] = self::calculate(attributes: $attributes);
        $room = self::renderRoomMetadata($date, $difference, $attributes);

        return EnableXService::createConnexion()
            ->post(config('enable.url').'/rooms', $room)
            ->json();
    }

    #[ArrayShape(['name' => 'string', 'owner_ref' => 'string', 'settings' => 'array', 'sip' => 'false[]'])]
    private static function renderRoomMetadata($date, $difference, $attributes): array
    {
        return [
            'name' => ''.$attributes->input('name'),
            'owner_ref' => ''.(new self())->generateStringValues(910, 9999999),
            'settings' => [
                'description' => ''.$attributes->input('name'),
                'mode' => 'group',
                'scheduled' => false,
                'adhoc' => false,
                'duration' => $difference,
                'moderators' => $attributes->input('moderator') ?? '2',
                'participants' => ''.$attributes->input('participant'),
                'billing_code' => '',
                'auto_recording' => false,
                'quality' => 'SD',
                'canvas' => true,
                'screen_share' => false,
                'abwd' => true,
                'max_active_talkers' => $attributes->input('participant'),
                'knock' => false,
                'scheduled_time' => ''.$date,
                'wait_for_moderator' => false,
                'media_zone' => 'US',
                'single_file_recording' => false,
                'role_based_recording' => [
                    'moderator' => 'audiovideo',
                    'participant' => 'audio',
                ],
                'live_recording' => [
                    'auto_recording' => true,
                    'url' => 'https://your-custom-view-url',
                ],
            ],
            'sip' => [
                'enabled' => false,
            ],
            'data' => [
                'custom_key' => '',
            ],
        ];
    }

    public function update(LessonUpdateRequest $request, $lesson)
    {
    }
}
