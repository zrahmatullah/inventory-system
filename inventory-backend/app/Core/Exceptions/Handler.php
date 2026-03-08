<?php

namespace App\Core\Exceptions;

use Throwable;
use Illuminate\Validation\ValidationException;

class Handler
{

    public static function handle(Throwable $e)
    {

        if ($e instanceof ValidationException) {
            return response()->json([
                "success" => false,
                "message" => "Validation Error",
                "errors" => $e->errors()
            ], 422);
        }

        return response()->json([
            "success" => false,
            "message" => $e->getMessage()
        ], 500);
    }

}