<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CustomException;
use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\UseCases\TwoWeekShiftPattern\AssignUserUseCase;
use App\UseCases\TwoWeekShiftPattern\GetByIdUseCase;
use App\UseCases\TwoWeekShiftPattern\GetUseCase;
use App\UseCases\TwoWeekShiftPattern\InsertUseCase;
use Illuminate\Http\Request;

class TwoWeekShiftPatternController extends Controller
{
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
        AssignUserUseCase $assignUserUseCase) {
        $this->insertUseCase = $insertUseCase;
        $this->getUseCase = $getUseCase;
        $this->getByIdUseCase = $getByIdUseCase;
        $this->assignUserUseCase = $assignUserUseCase;
    }

    public function get() {
        try {
            $shift_pattern = $this->getUseCase->execute();
            return ApiFormatter::createApi(
                200,
                'Success get two week shift patterns',
                $shift_pattern,
                'success'
            );
        } catch (\Exception $exception) {
            if ($exception instanceof CustomException) {
                return APIFormatter::createApi($exception->getCode(), $exception->getMessage(), [], 'fail');
            }
            return APIFormatter::createApi(500, 'Internal server error', [], 'fail');
        }
    }

    public function get_by_id($id) {
        try {
            $shift_pattern = $this->getByIdUseCase->execute((int) $id);
            return ApiFormatter::createApi(
                200,
                'Success get two week shift pattern by id',
                $shift_pattern,
                'success'
            );
        } catch (\Exception $exception) {
            if ($exception instanceof CustomException) {
                return APIFormatter::createApi($exception->getCode(), $exception->getMessage(), [], 'fail');
            }
            return APIFormatter::createApi(500, 'Internal server error', [], 'fail');
        }
    }

    public function insert(Request $request) {
        try {
            $name = $request->input('name');
            $start_date = $request->input('start_date');
            $monday_shift_id = $request->input('monday_shift_id');
            $tuesday_shift_id = $request->input('tuesday_shift_id');
            $wednesday_shift_id = $request->input('wednesday_shift_id');
            $thursday_shift_id = $request->input('thursday_shift_id');
            $friday_shift_id = $request->input('friday_shift_id');
            $saturday_shift_id = $request->input('saturday_shift_id');
            $sunday_shift_id = $request->input('sunday_shift_id');
            $second_monday_shift_id = $request->input('second_monday_shift_id');
            $second_tuesday_shift_id = $request->input('second_tuesday_shift_id');
            $second_wednesday_shift_id = $request->input('second_wednesday_shift_id');
            $second_thursday_shift_id = $request->input('second_thursday_shift_id');
            $second_friday_shift_id = $request->input('second_friday_shift_id');
            $second_saturday_shift_id = $request->input('second_saturday_shift_id');
            $second_sunday_shift_id = $request->input('second_sunday_shift_id');

            $this->insertUseCase->execute(
                $name,
                $start_date,
                $monday_shift_id,
                $tuesday_shift_id,
                $wednesday_shift_id,
                $thursday_shift_id,
                $friday_shift_id,
                $saturday_shift_id,
                $sunday_shift_id,
                $second_monday_shift_id,
                $second_tuesday_shift_id,
                $second_wednesday_shift_id,
                $second_thursday_shift_id,
                $second_friday_shift_id,
                $second_saturday_shift_id,
                $second_sunday_shift_id
            );

            return APIFormatter::createApi(
                201,
                'Success insert two week shift pattern',
                [],
                'success');
        } catch (\Exception $exception) {
            if ($exception instanceof CustomException) {
                return APIFormatter::createApi($exception->getCode(), $exception->getMessage(), [], 'fail');
            }
            return APIFormatter::createApi(500, 'Internal server error', [], 'fail');
        }
    }

    public function assign_user(Request $request)
    {
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
