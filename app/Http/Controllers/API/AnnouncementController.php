<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CustomException;
use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\UseCases\Announcements\GetAnnouncementByIdUseCase;
use App\UseCases\GetAllAnnouncementUseCase;
use App\UseCases\GetLatest3AnnouncementUseCase;
use App\UseCases\UpdateAnnouncementUseCase;
use Illuminate\Http\Request;

class AnnouncementController extends Controller {
    protected $updateAnnouncementUseCase;
    protected $getLatest3AnnouncementUseCase;
    protected $getAllAnnouncementUseCase;
    protected $getAnnouncementByIdUseCase;

    public function __construct(
        UpdateAnnouncementUseCase $updateAnnouncementUseCase,
        GetLatest3AnnouncementUseCase  $getLatest3AnnouncementUseCase,
        GetAllAnnouncementUseCase $getAllAnnouncementUseCase,
        GetAnnouncementByIdUseCase $getAnnouncementByIdUseCase) {
        $this->updateAnnouncementUseCase = $updateAnnouncementUseCase;
        $this->getLatest3AnnouncementUseCase = $getLatest3AnnouncementUseCase;
        $this->getAllAnnouncementUseCase = $getAllAnnouncementUseCase;
        $this->getAnnouncementByIdUseCase = $getAnnouncementByIdUseCase;
    }

    public function get_by_id($id) {
        try {
//            $id = $request->input('id');
            $data = $this->getAnnouncementByIdUseCase->execute($id);
            return APIFormatter::createApi(200, 'success get announcement by id', $data, 'success');
        } catch (\Exception $e) {
            if ($e instanceof CustomException) {
                return APIFormatter::createApi($e->getCode(), $e->getMessage(), [], 'fail');
            }
            return APIFormatter::createApi(500, 'Internal server error', [], 'fail');
        }
    }

    public function update(Request $request) {
        try {
            $id = $request->input('id');
            $title = $request->input('title');
            $content = $request->input('content');
            $file = $request->file('file');
            $is_for_all = $request->input('is_for_all');
            $target_users = $request->input('target_users');
            $is_published = $request->input('is_published');
            $created_by = $request->input('created_by');
            $this->updateAnnouncementUseCase->execute(
                $id,
                $title,
                $content,
                $file,
                $is_for_all,
                $target_users,
                $is_published,
                $created_by
            );
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully update announcement!',
            ]);
        } catch (\Exception $e) {
            if ($e instanceof CustomException) {
                return response()->json([
                    'status' => 'failed',
                    'message' => $e->getMessage()
                ], $e->getCode());
            }
            return response()->json([
                'status' => 'failed',
                'message' => 'Internal Server Error',
            ], 500);
        }
    }

    public function getAll() {
        try {
            $announcements = $this->getAllAnnouncementUseCase->execute();
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully get all announcements',
                'data' => $announcements,
            ]);
        } catch (\Exception $e) {
            if ($e instanceof CustomException) {
                return response()->json([
                    'status' => 'failed',
                    'message' => $e->getMessage()
                ], $e->getCode());
            }
            return response()->json([
                'status' => 'failed',
                'message' => 'Internal Server Error',
            ], 500);
        }
    }

    public function getLatest3Announcement() {
        try {
            $announcements = $this->getLatest3AnnouncementUseCase->execute();
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully get latest 3 announcement',
                'data' => $announcements,
            ]);
        } catch (\Exception $e) {
            if ($e instanceof CustomException) {
                return response()->json([
                    'status' => 'failed',
                    'message' => $e->getMessage()
                ], $e->getCode());
            }
            return response()->json([
                'status' => 'failed',
                'message' => 'Internal Server Error',
            ], 500);
        }
    }
}
