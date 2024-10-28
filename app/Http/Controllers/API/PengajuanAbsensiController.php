<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CustomException;
use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\UseCases\PengajuanAbsen\InsertUseCase;
use Illuminate\Http\Request;

class PengajuanAbsensiController extends Controller {
    protected $insertUseCase;
    public function __construct(InsertUseCase $insertUseCase) {
        $this->insertUseCase = $insertUseCase;
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
            return ApiFormatter::createApi(201, 'Success create pengajuan absensi', [], 'success');
        } catch (\Exception $exception) {
            if ($exception instanceof CustomException) {
                return APIFormatter::createApi($exception->getCode(), $exception->getMessage(), [], 'fail');
            }
            return APIFormatter::createApi(500, $exception->getMessage(), [], 'fail');
        }
    }
}
