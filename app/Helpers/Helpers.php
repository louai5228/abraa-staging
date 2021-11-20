<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Helpers
{
    public static function createSuccessResponse($data = null, $isLogin = false)
    {
        if ($isLogin) {
            $response = ['success' => true];
            $response['data'] = $data;
            return $response;
        }
        $response = ['isSuccessful' => true];
        $response['hasContent'] = $data ? true : false;
        $response['code'] = 200;
        $response['message'] = null;
        $response['detailed_error'] = null;
        $response['data'] = $data;
        return $response;
    }

    public static function createErrorResponse($message, $detailed_error = null, $error_code = 400, $isLogin = false)
    {
        if ($isLogin) {
            $response = ['success' => false];
            $response['data'] = $message;
            return $response;
        }
        $response = ['isSuccessful' => false];
        $response['code'] = $error_code;
        $response['hasContent'] = false;
        $response['message'] = $message;
        $response['detailed_error'] = $detailed_error;
        $response['data'] = null;
        return $response;
    }
}
