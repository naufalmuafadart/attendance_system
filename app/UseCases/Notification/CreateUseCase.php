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

    public function execute($destination_ids, $from_id, $from, $message, $action) {
        $this->notificationRepository->publish($destination_ids, $from_id, $from, $message, $action);
    }
}
