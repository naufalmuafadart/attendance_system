<?php

namespace App\Infrastructures;

use App\Repositories\StorageRepository;
use Illuminate\Support\Facades\Storage;

class LocalStorageRepository implements StorageRepository {
    public function download(string $path) {
        return Storage::download($path);
    }

    public function upload($file, $folder) : String {
        $fileContents = file_get_contents($file);
        $fileName = $folder.'/'.time().'_'.$file->getClientOriginalName();
        Storage::disk('local')->put($fileName, $fileContents);
        return $fileName;
    }
}
