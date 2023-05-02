<?php

namespace App\Services;

use Illuminate\Support\Facades\Response;

class ResponseService {

    public static function jsonResponse($data = [], $result = true, $message = 'Thành công!', $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            "result" => $result,
            "message" => $message,
            "data" => $data,
        ], $code);
    }

}
