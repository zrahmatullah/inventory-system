<?php

namespace App\Core\Services;

use App\Core\Responses\ApiResponse;

class BaseService
{

    protected function success($data = null, $message = "Success", $code = 200)
    {
        return ApiResponse::success($data, $message, $code);
    }

    protected function error($message = "Error", $code = 400, $data = null)
    {
        return ApiResponse::error($message, $code, $data);
    }

}