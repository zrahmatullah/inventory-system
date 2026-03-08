<?php

namespace App\Core\Providers;

use App\Core\Implement\MenuRepositoryImplement;

use App\Core\Implement\ModuleRepositoryImplement;
use App\Core\Implement\UserMenuRepositoryImplement;

use App\Core\Repositories\MenuRepository;
use App\Core\Repositories\ModuleRepository;
use App\Core\Repositories\UserMenuRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            ModuleRepository::class,
            ModuleRepositoryImplement::class
        );

        $this->app->bind(
            MenuRepository::class,
            MenuRepositoryImplement::class
        );

        $this->app->bind(
            UserMenuRepository::class,
            UserMenuRepositoryImplement::class
        );
    }

    public function boot()
    {
        //
    }
}