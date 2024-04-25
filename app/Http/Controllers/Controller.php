<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function success(mixed $data, String $message = 'okey', int $statusCode = 200): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    public function failed(String $message, int $statusCode = 400): JsonResponse {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $statusCode);
    }
}
