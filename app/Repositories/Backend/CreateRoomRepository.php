<?php

declare(strict_types=1);

namespace App\Repositories\Backend;

use App\Mail\RoomNotificationMail;
use App\Mail\SendEmailToGuestMail;
use App\Models\Room;
use App\Repositories\Contracts\CreateRoomRepositoryInterface;
use App\Services\EnableX;
use App\Traits\CalculationEvent;
use App\Traits\RandomValue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use JetBrains\PhpStorm\ArrayShape;

final class CreateRoomRepository implements CreateRoomRepositoryInterface
{
    use RandomValue, CalculationEvent;

    public function createRoom($attributes): Model|Builder
    {
        $rooms = $this->CreateOnlineRoom(attributes: $attributes);
        $currentTime = strtotime(''.$attributes->date.' '.$attributes->startTime.'');
        $date = date('Y-m-d H:i:s', $currentTime);
        $pinCode = rand(100000, 999999);
        $participant = $this->generateRandomTransaction(6);
        $guests = $attributes->guests;
        $timeZone = \Date::now();
        $organiser = $attributes->name;

        Mail::to($attributes->email)->send(new RoomNotificationMail($pinCode, $rooms, $date, $timeZone, $organiser, $attributes));

        foreach ($guests as $guest) {
            Mail::to($guest)->send(new SendEmailToGuestMail($participant, $rooms, $date, $timeZone, $guest, $attributes));
        }

        return Room::query()
            ->create([
                'name' => $attributes->name,
                'roomId' => $rooms['room']['room_id'],
                'roomName' => $rooms['room']['name'],
                'roomPin' => $pinCode,
                'reference' => $rooms['room']['owner_ref'],
                'schedule' => $date,
                'duration' => $rooms['room']['settings']['duration'],
                'usersNumber' => $rooms['room']['settings']['participants'],
                'guests' => serialize($attributes->guests),
                'password' => $participant,
                'institution_id'=>\Auth::user()->institution->id
            ]);
    }

    private function CreateOnlineRoom($attributes)
    {
        list($date, $difference) = $this->calculationDateOfEvent(attributes: $attributes);
        $room = $this->renderMetadataForRoom(date: $date, difference: $difference, attributes: $attributes);

        $response = new EnableX;

        return $response->createConnexion()
            ->post(config('enableX.url').'rooms/', $room)
            ->json();
    }

    #[ArrayShape(['name' => 'string', 'owner_ref' => 'string', 'settings' => 'array', 'sip' => 'false[]'])]
    private function renderMetadataForRoom($date, $difference, $attributes): array
    {
        return [
            'name' => 'Sample Room: '.$this->generateRandomTransaction(8),
            'owner_ref' => $this->generateRandomTransaction(8),
            'settings' => [
                'description' => '',
                'quality' => 'SD',
                'mode' => 'group',
                'participants' => $attributes->usersNumber,
                'duration' => $difference,
                'scheduled' => false,
                'moderators' => '2',
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
