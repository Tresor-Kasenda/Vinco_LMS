<?php

declare(strict_types=1);

namespace App\Services;

use Flasher\Prime\Notification\NotificationInterface;
use Flasher\SweetAlert\Prime\SweetAlertFactory;

final class ToastMessageService
{
    public function __construct(public SweetAlertFactory $factory)
    {
    }

    public function success(string $message): void
    {
        $this->factory->addFlash('success', $message);
    }

    public function error(string $message): void
    {
        $this->factory->addFlash('error', $message);
    }

    public function warning(string $message): void
    {
        $this->factory->addFlash(NotificationInterface::TYPE_WARNING, $message);
    }

    public function info(string $message): void
    {
        $this->factory->addFlash(NotificationInterface::TYPE_INFO, $message);
    }
}
