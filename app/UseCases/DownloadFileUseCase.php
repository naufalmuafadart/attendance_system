<?php

namespace App\UseCases;

use App\Repositories\StorageRepository;

class DownloadFileUseCase
{
    /**
     * @var StorageRepository
     */
    private $storageRepository;

    public function __construct(StorageRepository $storageRepository) {
        $this->storageRepository = $storageRepository;
    }

    public function execute(string $path) {
        return $this->storageRepository->download($path);
    }
}
