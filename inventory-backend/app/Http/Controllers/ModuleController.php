<?php

namespace App\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Core\Services\ModuleService;

class ModuleController extends Controller
{

    protected $service;

    public function __construct(ModuleService $service)
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
            'name' => 'required',
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
            'name' => 'required',
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