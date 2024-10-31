<?php

namespace App\Repositories;

interface PushNotificationRepository
{
    public function publish($notification_type, $user_id, $message, $action);
}
