<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\SidebarService;

class SidebarController extends Controller
{

    protected $service;

    public function __construct(SidebarService $service)
    {
        $this->service = $service;
    }

    public function index()
    {

        $userId = Auth::id();

        $data = $this->service->sidebar($userId);

        return response()->json($data);

    }

}