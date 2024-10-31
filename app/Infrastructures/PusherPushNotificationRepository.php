<?php

namespace App\Infrastructures;

use App\Events\NotifApproval;
use App\Repositories\PushNotificationRepository;

class PusherPushNotificationRepository implements PushNotificationRepository {
    public function publish($notification_type, $user_id, $message, $action) {
        NotifApproval::dispatch($notification_type, $user_id, $message, $action);
    }
}
