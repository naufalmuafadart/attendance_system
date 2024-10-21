<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\UseCases\UpdateAnnouncementUseCase;
use Illuminate\Http\Request;

class AnnouncementController extends Controller {
    protected $updateAnnouncementUseCase;

    public function __construct(UpdateAnnouncementUseCase $updateAnnouncementUseCase) {
        $this->updateAnnouncementUseCase = $updateAnnouncementUseCase;
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
            ], 500);
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
