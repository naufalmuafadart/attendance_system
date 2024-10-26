<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CustomException;
use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\UseCases\Shift\GetAllUseCase;
use App\UseCases\Shift\GetByUserIdAndDateUseCase;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    protected $getByUserIdAndDateUseCase;
    protected $getAllUseCase;
    public function __construct(GetByUserIdAndDateUseCase  $getByUserIdAndDateUseCase, GetAllUseCase  $getAllUseCase) {
        $this->getByUserIdAndDateUseCase = $getByUserIdAndDateUseCase;
        $this->getAllUseCase = $getAllUseCase;
    }

    public function get() {
        try {
            $shifts = $this->getAllUseCase->execute();
            return APIFormatter::createApi(200, 'success get all shifts', $shifts, 'success');
        } catch (\Exception $exception) {
            if ($exception instanceof CustomException) {
                return APIFormatter::createApi($exception->getCode(), $exception->getMessage(), [], 'fail');
            }
            return APIFormatter::createApi(500, $exception->getMessage(), [], 'fail');
        }
    }

    public function get_by_user_id_and_date(Request $request) {
        try {
            $user_id = $request->get('user_id');
            $date = $request->get('date');
            $shift = $this->getByUserIdAndDateUseCase->execute($user_id, $date);
            return APIFormatter::createApi(200, 'success get shift by user id and date', $shift, 'success');
        } catch (\Exception $exception) {
            if ($exception instanceof CustomException) {
                return APIFormatter::createApi($exception->getCode(), $exception->getMessage(), [], 'fail');
            }
            return APIFormatter::createApi(500, $exception->getMessage(), [], 'fail');
        }
    }
}
