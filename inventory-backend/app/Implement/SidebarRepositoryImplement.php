<?php

namespace App\Implement;

use App\Repositories\SidebarRepository;
use App\Models\Module;

class SidebarRepositoryImplement implements SidebarRepository
{

    public function getSidebarByUser($userId)
    {

        $modules = Module::active()
            ->with(['menus' => function($query) use ($userId){

                $query->active()
                    ->whereHas('userMenus', function($q) use ($userId){
                        $q->where('user_id',$userId)
                          ->where('is_active',true);
                    })
                    ->orderBy('order_no');

            }])
            ->orderBy('order_no')
            ->get();

        return $modules->map(function($module){

            return [
                "module" => $module->name,
                "menus" => $module->menus->map(function($menu){
                    return [
                        "name" => $menu->name,
                        "path" => $menu->path,
                        "icon" => $menu->icon
                    ];
                })
            ];

        });

    }

}