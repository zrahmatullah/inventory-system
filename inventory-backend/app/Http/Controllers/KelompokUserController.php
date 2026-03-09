<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\KelompokUserService;

class KelompokUserController extends Controller
{

    protected $service;

    public function __construct(KelompokUserService $service)
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
            'nama_kelompok'=>'required|string|max:100'
        ]);

        return response()->json(
            $this->service->create($data)
        );

    }

    public function update(Request $request,$id)
    {

        $data = $request->validate([
            'nama_kelompok'=>'required|string|max:100',
            'is_active'=>'boolean'
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