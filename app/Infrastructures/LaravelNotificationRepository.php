<?php

namespace App\Infrastructures;

use App\Events\NotifApproval;
use App\Models\User;
use App\Notifications\UserNotification;
use App\Repositories\NotificationRepository;

class LaravelNotificationRepository implements NotificationRepository {
    public function publish($ids, $from_id, $from, $message, $action) {
        $notification_type = 'Approval';

        $users = User::whereIn('id', $ids)->get();
        foreach ($users as $user) {
            $user->messages = [
                'user_id' => $from_id,
                'from' => $from,
                'message' => $message,
                'action' => $action,
            ];
            $user->notify(new UserNotification);

            NotifApproval::dispatch($notification_type, $user->id, $message, $action);
        }
    }
}
