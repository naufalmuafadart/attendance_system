<?php

namespace App\UseCases;

use App\Entities\Announcement\UpdateAnnouncementEntity;
use App\Repositories\AnnouncementRepository;
use App\Repositories\StorageRepository;

class UpdateAnnouncementUseCase {
    protected $storageRepository;
    protected $announcementRepository;
    public function __construct(StorageRepository $storageRepository, AnnouncementRepository $announcementRepository)
    {
        $this->storageRepository = $storageRepository;
        $this->announcementRepository = $announcementRepository;
    }

    public function execute($id, $title, $content, $file, $is_for_all, $target_users, $is_published, $created_by) {
        if ($file != null) {
            $file = $this->storageRepository->upload($file, 'uploads/announcement');
        }
        $announcement = new UpdateAnnouncementEntity($id, $title, $content, $file, $is_for_all, $target_users, $is_published, $created_by);
        $this->announcementRepository->update($announcement);
    }
}
