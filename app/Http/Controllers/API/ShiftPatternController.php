<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CustomException;
use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\UseCases\ShiftPattern\AssignUserUseCase;
use App\UseCases\ShiftPattern\GetByIdUseCase;
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

    /**
     * @var GetByIdUseCase
     */
    private $getByIdUseCase;

    /**
     * @var AssignUserUseCase
     */
    private $assignUserUseCase;

    public function __construct(
        InsertUseCase $insertUseCase,
        GetUseCase $getUseCase,
        GetByIdUseCase $getByIdUseCase,
        AssignUserUseCase  $assignUserUseCase) {
        $this->insertUseCase = $insertUseCase;
        $this->getUseCase = $getUseCase;
        $this->getByIdUseCase = $getByIdUseCase;
        $this->assignUserUseCase = $assignUserUseCase;
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

    public function get_by_id($id): \Illuminate\Http\JsonResponse {
        try {
            $shift_pattern = $this->getByIdUseCase->execute($id);
            return APIFormatter::createApi(
                200,
                'Success get shift by id',
                $shift_pattern,
                'success');
        } catch (\Exception $exception) {
            if ($exception instanceof CustomException) {
                return APIFormatter::createApi($exception->getCode(), $exception->getMessage(), [], 'fail');
            }
            return APIFormatter::createApi(500, 'Internal server error', [], 'fail');
        }
    }

    public function assign_user(Request $request): \Illuminate\Http\JsonResponse {
        try {
            $arr_id = $request->input('arr_id');
            $shift_pattern_id = $request->input('shift_pattern_id');
            $this->assignUserUseCase->execute($arr_id, $shift_pattern_id);
            return APIFormatter::createApi(
                200,
                'Success assign user',
                [],
                'success');
        } catch (\Exception $exception) {
            if ($exception instanceof CustomException) {
                return APIFormatter::createApi($exception->getCode(), $exception->getMessage(), [], 'fail');
            }
            return APIFormatter::createApi(500, 'Internal server error', [], 'fail');
        }
    }
}
