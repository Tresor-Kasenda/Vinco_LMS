<?php

declare(strict_types=1);

namespace App\Repositories\EnableX;

use App\Contracts\EnableX\CreateRoomRepositoryInterface;
use App\Jobs\RoomNotification;
use App\Jobs\StudentNotificationRoom;
use App\Models\Live;
use App\Services\EnableX\EnableXService;
use App\Services\ToastMessageService;
use App\Traits\RandomValues;
use App\Traits\TimeCalculation;
use JetBrains\PhpStorm\ArrayShape;

class CreateRoomRepository implements CreateRoomRepositoryInterface
{
    use TimeCalculation, RandomValues;

    public function __construct(
        protected ToastMessageService $service
    ) {
    }

    public function createRooms($attributes)
    {
        $rooms = self::create(attributes: $attributes);
        $currentTime = strtotime(''.$attributes->date.' '.$attributes->startTime.'');
        $date = date('Y-m-d H:i:s', $currentTime);
        $pinCode = rand(100000, 999999);
        $participant = $this->generateStringValues(0, 9999);
        $guests = $attributes->input('guests');

        RoomNotification::dispatch(
            $pinCode,
            $rooms,
            $date,
            $attributes
        )
            ->delay(now()->addSecond(10));

        foreach ($guests as $guest) {
            StudentNotificationRoom::dispatch(
                $participant,
                $rooms,
                $date,
                $guest,
                $attributes
            )
                ->delay(now()->addSecond(10));
        }

        return Live::query()
            ->create([
                'name' => $attributes->input('name'),
                'firstName' => $attributes->input('firstName'),
                'roomId' => $rooms['room']['room_id'],
                'roomName' => $rooms['room']['name'],
                'roomPin' => $pinCode,
                'reference' => $rooms['room']['owner_ref'],
                'schedule' => $date,
                'duration' => $rooms['room']['settings']['duration'],
                'usersNumber' => $rooms['room']['settings']['participants'],
                'guests' => serialize($attributes->input('guests')),
                'password' => $participant,
                'city' => $attributes->input('city'),
                'country' => $attributes->input('country'),
            ]);
    }

    private static function create($attributes)
    {
        [$date, $difference] = self::calculate(attributes: $attributes);
        $room = self::renderRoomMetadata($date, $difference, $attributes);

        return EnableXService::createConnexion()
            ->post(config('enable.config.url').'/rooms', $room)
            ->json();
    }

    #[ArrayShape(['name' => 'string', 'owner_ref' => 'string', 'settings' => 'array', 'sip' => 'false[]'])]
    private static function renderRoomMetadata($date, $difference, $attributes): array
    {
        return [
            'name' => 'Sample Room',
            'owner_ref' => '',
            'settings' => [
                'description' => '',
                'quality' => 'SD',
                'mode' => 'group',
                'participants' => $attributes->input('participant'),
                'duration' => $difference,
                'scheduled' => false,
                'moderators' => $attributes->input('moderator') ?? '2',
                'scheduled_time' => ''.$date,
                'auto_recording' => false,
                'active_talker' => true,
                'wait_moderator' => false,
                'adhoc' => false,
                'canvas' => true,
            ],
            'sip' => [
                'enabled' => false,
            ],
        ];
    }
}
