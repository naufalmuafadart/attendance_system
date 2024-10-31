<?php

namespace App\Repositories;

interface NotificationRepository {
    public function publish($ids, $from_id, $from, $message, $action);
}
