<?php

namespace App\Repositories;

interface PushNotificationRepository
{
    public function send($message);
}
