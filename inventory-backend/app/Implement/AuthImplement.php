<?php

namespace App\Implement;

use App\Services\AuthService;

class AuthImplement
{

    protected $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function login($request)
    {
        return $this->service->login($request);
    }

}