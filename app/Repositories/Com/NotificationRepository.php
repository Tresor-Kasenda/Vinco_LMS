<?php

declare(strict_types=1);

namespace App\Repositories\Com;

use App\Contracts\NotificationRepositoryInterface;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

final class NotificationRepository implements NotificationRepositoryInterface
{
    public function notifications(): array|Collection|\Illuminate\Support\Collection
    {
        return Notification::query()
            ->orderByDesc('created_at')
            ->get();
    }

    public function showNotification(string $key): Model|Builder|Notification
    {
        return Notification::query()
            ->where('id', '=', $key)
            ->firstOrFail();
    }

    public function stored($attributes): Model|Builder|Notification
    {
        $notification = Notification::query()
            ->create([
//                'title' => $attributes->input('title'),
                'id'=>Str::random(16),
                'data' => $attributes->input('content'),
                'type'=>'1',
                'notifiable_id'=>0,
                'notifiable_type'=>"oklm"
            ]);

        return $notification;
    }

    public function updated(string $key, $attributes): Model|Builder|Notification
    {
        $notification = $this->showNotification($key);
        $notification->update([
            'data' => $attributes->input('content'),
            'type'=>'1',
            'notifiable_id'=>0,
            'notifiable_type'=>"oklm"
        ]);


        return $notification;
    }

    public function deleted(string $key): Model|Builder|Notification
    {
        $notification = $this->showNotification($key);

        $notification->delete();

        return $notification;
    }
}
