<?php

namespace App\Repositories;

interface SidebarRepository
{
    public function getSidebarByUser($userId);
}