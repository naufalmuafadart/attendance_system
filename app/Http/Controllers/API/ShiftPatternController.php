<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CustomException;
use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\UseCases\ShiftPattern\GetUseCase;
use App\UseCases\ShiftPattern\InsertUseCase;
use Illuminate\Http\Request;

class ShiftPatternController extends Controller {
    /**
     * @var InsertUseCase
     */
    private $insertUseCase;

    /**
     * @var GetUseCase
     */
    private $getUseCase;

    public function __construct(InsertUseCase $insertUseCase, GetUseCase $getUseCase) {
        $this->insertUseCase = $insertUseCase;
        $this->getUseCase = $getUseCase;
    }

    public function insert(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $name = $request->input('name');
            $monday_shift_id = $request->input('monday_shift_id');
            $tuesday_shift_id = $request->input('tuesday_shift_id');
            $wednesday_shift_id = $request->input('wednesday_shift_id');
            $thursday_shift_id = $request->input('thursday_shift_id');
            $friday_shift_id = $request->input('friday_shift_id');
            $saturday_shift_id = $request->input('saturday_shift_id');
            $sunday_shift_id = $request->input('sunday_shift_id');
            $this->insertUseCase->execute(
                $name,
                $monday_shift_id,
                $tuesday_shift_id,
                $wednesday_shift_id,
                $thursday_shift_id,
                $friday_shift_id,
                $saturday_shift_id,
                $sunday_shift_id
            );
            return APIFormatter::createApi(
                201,
                'Success add shift pattern',
                [],
                'success');
        } catch (\Exception $exception) {
            if ($exception instanceof CustomException) {
                return APIFormatter::createApi($exception->getCode(), $exception->getMessage(), [], 'fail');
            }
            return APIFormatter::createApi(500, 'Internal server error', [], 'fail');
        }
    }

    public function get(): \Illuminate\Http\JsonResponse {
        try {
            $shift_patterns = $this->getUseCase->execute();
            return APIFormatter::createApi(
                200,
                'Success get shift patterns',
                $shift_patterns,
                'success');
        } catch (\Exception $exception) {
            if ($exception instanceof CustomException) {
                return APIFormatter::createApi($exception->getCode(), $exception->getMessage(), [], 'fail');
            }
            return APIFormatter::createApi(500, 'Internal server error', [], 'fail');
        }
    }
}