<?php

namespace App\Repositories;

interface StorageRepository {
    public function download(string $path);
    public function upload($file, $folder) : String;
}
