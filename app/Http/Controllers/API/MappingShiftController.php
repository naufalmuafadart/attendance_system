<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CustomException;
use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\UseCases\MappingShift\InsertUseCase;
use Illuminate\Http\Request;

class MappingShiftController extends Controller {
    protected $insertUseCase;

    public function __construct(InsertUseCase $insertUseCase) {
        $this->insertUseCase = $insertUseCase;
    }

    public function insert(Request $request) {
        try {
            $this->insertUseCase->execute(
                $request->input('shift_id'),
                $request->input('selected_ids'),
                $request->input('start_date'),
                $request->input('end_date'),
                $request->input('is_lock_location'),
            );
            return APIFormatter::createApi(201, 'Success insert mapping shift', [], 'success');
        } catch (\Exception $exception) {
            if ($exception instanceof CustomException) {
                return APIFormatter::createApi($exception->getCode(), $exception->getMessage(), [], 'fail');
            }
            return APIFormatter::createApi(500, 'Internal server error', [], 'fail');
        }
    }
}
