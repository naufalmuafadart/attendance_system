<?php

namespace App\UseCases\Announcements;

use App\Repositories\AnnouncementRepository;

class GetAnnouncementByIdUseCase {
    public function __construct(AnnouncementRepository $announcementRepository) {
        $this->announcementRepository = $announcementRepository;
    }

    public function execute($id) {
        return $this->announcementRepository->get_by_id($id);
    }
}
