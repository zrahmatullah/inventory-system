<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\UserLoginHistory;

class AuthService
{

    protected $repo;

    public function __construct(AuthRepository $repo)
    {
        $this->repo = $repo;
    }

    public function login($request)
    {

        $user = $this->repo->findUserByEmail($request->email);

        if(!$user){
            return [
                "success"=>false,
                "message"=>"User tidak ditemukan"
            ];
        }

        if(!$user->kelompokUser || !$user->kelompokUser->is_active){
            return [
                "success"=>false,
                "message"=>"Kelompok user tidak aktif"
            ];
        }

        if(!Hash::check($request->password,$user->password)){
            return [
                "success"=>false,
                "message"=>"Password salah"
            ];
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        // simpan login history
        UserLoginHistory::create([
            'user_id'=>$user->id,
            'ip_address'=>request()->ip(),
            'user_agent'=>request()->userAgent(),
            'login_at'=>now(),
            'is_active'=>true
        ]);

        return [
            "success"=>true,
            "token"=>$token,
            "user"=>$user,
            "role"=>$user->kelompokUser->nama_kelompok
        ];

    }

}