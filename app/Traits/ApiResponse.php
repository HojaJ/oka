<?php

namespace App\Traits;

trait ApiResponse
{
    public function successResponse($data, $code = 200)
    {
        return response()->json(['success' => true] + $data, $code);
    }

    public function errorResponse($message, $code = 500)
    {
        return response()->json(['success' => false, 'code' => $code, 'message' => $message], $code);
    }
}