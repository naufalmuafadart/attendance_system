<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\UseCases\DownloadAnnouncementFileUseCase;
use App\UseCases\DownloadFileUseCase;
use Illuminate\Http\Request;

class DownloadController extends Controller {
    public $downloadAnnouncementFileUseCase;
    /**
     * @var DownloadFileUseCase
     */
    private $downloadFileUseCase;

    public function __construct(DownloadAnnouncementFileUseCase $downloadAnnouncementFileUseCase, DownloadFileUseCase $downloadFileUseCase) {
        $this->downloadAnnouncementFileUseCase = $downloadAnnouncementFileUseCase;
        $this->downloadFileUseCase = $downloadFileUseCase;
    }

    public function get(Request $request) {
        try {
            $path = $request->get('path');
            return $this->downloadFileUseCase->execute($path);
        } catch (\Exception $exception) {
            if ($exception instanceof CustomException) {
                return response()->json([
                    'status' => 'failed',
                    'message' => $exception->getMessage()
                ], $exception->getCode());
            }
            return response()->json([
                'status' => 'failed',
//                'message' => 'Internal Server Error',
                'message' => $exception->getMessage(),
            ], 500);
        }
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
