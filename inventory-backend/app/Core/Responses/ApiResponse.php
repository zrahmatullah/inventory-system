<?php

namespace App\Core\Responses;

class ApiResponse
{

    public static function success($data = null, $message = "Success", $code = 200)
    {
        return [
            "success" => true,
            "message" => $message,
            "data" => $data,
            "code" => $code
        ];
    }

    public static function error($message = "Error", $code = 400, $data = null)
    {
        return [
            "success" => false,
            "message" => $message,
            "data" => $data,
            "code" => $code
        ];
    }

}