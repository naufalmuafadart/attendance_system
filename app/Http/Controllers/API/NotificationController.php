<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CustomException;
use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\UseCases\Notification\CreateUseCase;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * @var CreateUseCase
     */
    private $createUseCase;

    public function __construct(CreateUseCase $createUseCase) {
        $this->createUseCase = $createUseCase;
    }

    public function create(Request $request) {
        try {
            $this->createUseCase->execute();
            return ApiFormatter::createApi(201, 'Success create notification', [], 'success');
        } catch (\Exception $exception) {
            if ($exception instanceof CustomException) {
                return APIFormatter::createApi($exception->getCode(), $exception->getMessage(), [], 'fail');
            }
            return APIFormatter::createApi(500, $exception->getMessage(), [], 'fail');
        }
    }
}
