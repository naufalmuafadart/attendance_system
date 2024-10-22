<?php

namespace App\UseCases;

use App\Repositories\AnnouncementRepository;

class GetLatest3AnnouncementUseCase {
    public function __construct(AnnouncementRepository $announcementRepository) {
        $this->announcementRepository = $announcementRepository;
    }

    public function execute() {
        return $this->announcementRepository->get_latest_3();
    }
}
