<?php

namespace App\UseCases;

use App\Models\Announcement;
use App\Repositories\AnnouncementRepository;
use App\Repositories\StorageRepository;

class DownloadAnnouncementFileUseCase
{
    protected $storageRepository;
    protected $announcementRepository;
    public function __construct(StorageRepository $storageRepository, AnnouncementRepository $announcementRepository)
    {
        $this->storageRepository = $storageRepository;
        $this->announcementRepository = $announcementRepository;
    }

    public function execute($id) {
        $announcement = $this->announcementRepository->get_by_id($id);
        return $this->storageRepository->download($announcement->file);
    }
}
