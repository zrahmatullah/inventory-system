<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\ModuleRepository;
use App\Repositories\MenuRepository;
use App\Repositories\UserMenuRepository;
use App\Repositories\SidebarRepository;
use App\Repositories\UserRepository;
use App\Repositories\KelompokUserRepository;

use App\Implement\ModuleRepositoryImplement;
use App\Implement\MenuRepositoryImplement;
use App\Implement\UserMenuRepositoryImplement;
use App\Implement\SidebarRepositoryImplement;
use App\Implement\UserRepositoryImplement;
use App\Implement\KelompokUserRepositoryImplement;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {

        $this->app->bind(ModuleRepository::class, ModuleRepositoryImplement::class);

        $this->app->bind(MenuRepository::class, MenuRepositoryImplement::class);

        $this->app->bind(UserMenuRepository::class, UserMenuRepositoryImplement::class);

        $this->app->bind(SidebarRepository::class, SidebarRepositoryImplement::class);

        $this->app->bind(UserRepository::class, UserRepositoryImplement::class);

        $this->app->bind(KelompokUserRepository::class, KelompokUserRepositoryImplement::class);

    }

    public function boot()
    {
        //
    }
}