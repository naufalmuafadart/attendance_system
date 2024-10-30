<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CustomException;
use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\UseCases\AttendanceRequest\ApproveUseCase;
use App\UseCases\AttendanceRequest\GetForUserViewUseCase;
use App\UseCases\AttendanceRequest\GetForAdminViewUseCase;
use App\UseCases\AttendanceRequest\GetUseCase;
use App\UseCases\AttendanceRequest\RejectUseCase;
use App\UseCases\PengajuanAbsen\InsertUseCase;
use Illuminate\Http\Request;

class AttendanceRequest extends Controller {
    protected $insertUseCase;
    protected $getUseCase;
    /**
     * @var GetForAdminViewUseCase
     */
    private $getForAdminViewUseCase;

    /**
     * @var ApproveUseCase
     */
    private $approveUseCase;

    /**
     * @var RejectUseCase
     */
    private $rejectUseCase;

    /**
     * @var GetForUserViewUseCase
     */
    private $getByUserIdUseCase;

    public function __construct(
        InsertUseCase          $insertUseCase,
        GetUseCase             $getUseCase,
        GetForAdminViewUseCase $getForAdminViewUseCase,
        ApproveUseCase         $approveUseCase,
        RejectUseCase          $rejectUseCase,
        GetForUserViewUseCase  $getByUserIdUseCase) {
        $this->insertUseCase = $insertUseCase;
        $this->getUseCase = $getUseCase;
        $this->getForAdminViewUseCase = $getForAdminViewUseCase;
        $this->approveUseCase = $approveUseCase;
        $this->rejectUseCase = $rejectUseCase;
        $this->getByUserIdUseCase = $getByUserIdUseCase;
    }

    public function insert(Request $request) {
        try {
            $user_id = $request->get('user_id');
            $date = $request->get('date');
            $clock_in = $request->get('clock_in');
            $clock_out = $request->get('clock_out');
            $reason = $request->get('reason');
            $file = $request->file('file');

            $this->insertUseCase->execute($user_id, $date, $clock_in, $clock_out, $reason, $file);
            return ApiFormatter::createApi(201, 'Success create attendance request', [], 'success');
        } catch (\Exception $exception) {
            if ($exception instanceof CustomException) {
                return APIFormatter::createApi($exception->getCode(), $exception->getMessage(), [], 'fail');
            }
            return APIFormatter::createApi(500, $exception->getMessage(), [], 'fail');
        }
    }

    public function get() {
        try {
            $data = $this->getUseCase->execute();
            return ApiFormatter::createApi(200, 'Success fetch attendance request', $data, 'success');
        } catch (\Exception $exception) {
            if ($exception instanceof CustomException) {
                return APIFormatter::createApi($exception->getCode(), $exception->getMessage(), [], 'fail');
            }
            return APIFormatter::createApi(500, $exception->getMessage(), [], 'fail');
        }
    }

    public function get_for_admin_view() {
        try {
            $data = $this->getForAdminViewUseCase->execute();
            return ApiFormatter::createApi(200, 'Success fetch attendance request', $data, 'success');
        } catch (\Exception $exception) {
            if ($exception instanceof CustomException) {
                return APIFormatter::createApi($exception->getCode(), $exception->getMessage(), [], 'fail');
            }
            return APIFormatter::createApi(500, $exception->getMessage(), [], 'fail');
        }
    }

    public function approve($id) {
        try {
            $this->approveUseCase->execute($id);
            return ApiFormatter::createApi(200, 'Success approve attendance request', [], 'success');
        } catch (\Exception $exception) {
            if ($exception instanceof CustomException) {
                return APIFormatter::createApi($exception->getCode(), $exception->getMessage(), [], 'fail');
            }
            return APIFormatter::createApi(500, $exception->getMessage(), [], 'fail');
        }
    }

    public function reject($id, Request $request)
    {
        try {
            $reason = $request->get('reason');
            $this->rejectUseCase->execute($id, $reason);
            return ApiFormatter::createApi(200, 'Success reject attendance request', [], 'success');
        } catch (\Exception $exception) {
            if ($exception instanceof CustomException) {
                return APIFormatter::createApi($exception->getCode(), $exception->getMessage(), [], 'fail');
            }
            return APIFormatter::createApi(500, $exception->getMessage(), [], 'fail');
        }
    }

    public function get_for_user_view($user_id) {
        try {
            $requests = $this->getByUserIdUseCase->execute($user_id);
            return ApiFormatter::createApi(
                200,
                'Success get attendance for user view',
                $requests,
                'success'
            );
        } catch (\Exception $exception) {
            if ($exception instanceof CustomException) {
                return APIFormatter::createApi($exception->getCode(), $exception->getMessage(), [], 'fail');
            }
            return APIFormatter::createApi(500, $exception->getMessage(), [], 'fail');
        }
    }
}
