<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\UseCases\DownloadAnnouncementFileUseCase;
use Illuminate\Http\Request;

class DownloadController extends Controller {
    public $downloadAnnouncementFileUseCase;

    public function __construct(DownloadAnnouncementFileUseCase $downloadAnnouncementFileUseCase) {
        $this->downloadAnnouncementFileUseCase = $downloadAnnouncementFileUseCase;
    }

    public function from_announcement(Request $request) {
        try {
            $id = $request->input('id');
            return $this->downloadAnnouncementFileUseCase->execute($id);
        } catch (\Exception $exception) {
            if ($exception instanceof CustomException) {
                return response()->json([
                    'status' => 'failed',
                    'message' => $exception->getMessage()
                ], $exception->getCode());
            }
            return response()->json([
                'status' => 'failed',
                'message' => 'Internal Server Error',
            ], 500);
        }
    }
}
