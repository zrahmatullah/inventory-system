<?php

namespace App\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Core\Services\UserMenuService;

class UserMenuController extends Controller
{

    protected $service;

    public function __construct(UserMenuService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json(
            $this->service->list()
        );
    }

    public function show($id)
    {
        return response()->json(
            $this->service->detail($id)
        );
    }

    public function userMenus($userId)
    {
        return response()->json(
            $this->service->listByUser($userId)
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'menu_id' => 'required|integer'
        ]);

        return response()->json(
            $this->service->create($data)
        );
    }

    public function update(Request $request,$id)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'menu_id' => 'required|integer',
            'is_active' => 'boolean'
        ]);

        return response()->json(
            $this->service->update($id,$data)
        );
    }

    public function destroy($id)
    {
        return response()->json(
            $this->service->delete($id)
        );
    }
}