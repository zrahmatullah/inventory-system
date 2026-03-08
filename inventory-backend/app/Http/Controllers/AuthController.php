<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Implement\AuthImplement;
use App\Models\UserLoginHistory;

class AuthController extends Controller
{

    protected $auth;

    public function __construct(AuthImplement $auth)
    {
        $this->auth = $auth;
    }

    public function login(Request $request)
    {

        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $result = $this->auth->login($request);

        return response()->json($result);

    }

    public function logout(Request $request)
    {

        $user = $request->user();

        $history = UserLoginHistory::where('user_id',$user->id)
            ->whereNull('logout_at')
            ->latest()
            ->first();

        if($history){
            $history->update([
                'logout_at'=>now()
            ]);
        }

        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "success"=>true,
            "message"=>"Logout success"
        ]);

    }

}