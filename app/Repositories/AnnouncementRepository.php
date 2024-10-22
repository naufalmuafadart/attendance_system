<?php

namespace App\Repositories;

use App\Entities\Announcement\UpdateAnnouncementEntity;

interface AnnouncementRepository {
    public function get_by_id($id);
    public function update(UpdateAnnouncementEntity $update_announcement);
    public function get_latest_3();
}
