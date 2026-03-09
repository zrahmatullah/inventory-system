<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Core\Services\MenuService;

class MenuController extends Controller
{

    protected $service;

    public function __construct(MenuService $service)
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

    public function store(Request $request)
    {
        $data = $request->validate([
            'module_id' => 'required|integer',
            'name' => 'required',
            'path' => 'nullable',
            'icon' => 'nullable',
            'order_no' => 'nullable|integer'
        ]);

        return response()->json(
            $this->service->create($data)
        );
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'module_id' => 'required|integer',
            'name' => 'required',
            'path' => 'nullable',
            'icon' => 'nullable',
            'order_no' => 'nullable|integer'
        ]);

        return response()->json(
            $this->service->update($id, $data)
        );
    }

    public function destroy($id)
    {
        return response()->json(
            $this->service->delete($id)
        );
    }
}