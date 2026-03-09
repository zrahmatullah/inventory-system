<?php

namespace App\Services;

use App\Repositories\SidebarRepository;

class SidebarService
{

    protected $repository;

    public function __construct(SidebarRepository $repository)
    {
        $this->repository = $repository;
    }

    public function sidebar($userId)
    {
        return $this->repository->getSidebarByUser($userId);
    }

}