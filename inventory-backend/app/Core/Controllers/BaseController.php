<?php

namespace App\Core\Controllers;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{

    protected function response($result)
    {
        $status = $result['code'] ?? 200;

        unset($result['code']);

        return response()->json($result, $status);
    }

}