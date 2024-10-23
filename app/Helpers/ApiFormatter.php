<?php

namespace App\Helpers;

class ApiFormatter{
    protected static $response = [
        'code' => null,
        'message' => null,
        'data' => null,
    ];

    public static function createApi($code = null, $message = null, $data = null, $status = null) {
        self::$response['code'] = $code;
        self::$response['message'] = $message;
        self::$response['data'] = $data;
        self::$response['status'] = $status;

        return response()->json(self::$response, self::$response['code']);
    }
}
