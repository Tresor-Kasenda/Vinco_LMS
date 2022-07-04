<?php

declare(strict_types=1);

namespace App\Repositories\Com;

use App\Contracts\NotificationRepositoryInterface;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class NotificationRepository implements NotificationRepositoryInterface
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

    public function stored($attributes, $factory): Model|Builder|Notification
    {
        $notification = Notification::query()
            ->create([
                'title' => $attributes->input('title'),
                'content' => $attributes->input('content'),
            ]);
        $factory->addSuccess('Notification added with successfully');

        return $notification;
    }

    public function updated(string $key, $attributes, $factory): Model|Builder|Notification
    {
        $notification = $this->showNotification($key);
        $notification->update([
            'title' => $attributes->input('title'),
            'content' => $attributes->input('content'),
        ]);

        $factory->addSuccess('Notification updated with successfully');

        return $notification;
    }

    public function deleted(string $key, $factory): Model|Builder|Notification
    {
        $notification = $this->showNotification($key);

        $notification->delete();

        $factory->addSuccess('Notification deleted with successfully');

        return $notification;
    }
}
