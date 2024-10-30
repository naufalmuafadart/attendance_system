<?php

namespace App\Infrastructures;

use App\Repositories\StorageRepository;
use Illuminate\Support\Facades\Storage;

class LocalStorageRepository implements StorageRepository {
    public function download(string $path) {
        return Storage::download(substr($path, 7));
    }

    public function upload($file, $folder) : String {
        $fileContents = file_get_contents($file);
        $fileName = 'public/'.$folder.'/'.time().'_'.$file->getClientOriginalName();
        Storage::disk('local')->put($fileName, $fileContents, 'public');
        return $fileName;
    }
}
