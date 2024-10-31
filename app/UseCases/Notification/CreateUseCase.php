<?php

namespace App\UseCases\Notification;

use App\Repositories\NotificationRepository;

class CreateUseCase
{
    /**
     * @var NotificationRepository
     */
    private $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository) {
        $this->notificationRepository = $notificationRepository;
    }

    public function execute() {
        $this->notificationRepository->publish([1], 1659, 'Widi', 'Test', '/dashboard');
    }
}
