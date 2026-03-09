<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{

    protected $service;

    public function __construct(UserService $service)
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
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'kelompok_user_id'=>'nullable|integer'
        ]);

        return response()->json(
            $this->service->create($data)
        );
    }

    public function update(Request $request,$id)
    {

        $data = $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'kelompok_user_id'=>'nullable|integer',
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