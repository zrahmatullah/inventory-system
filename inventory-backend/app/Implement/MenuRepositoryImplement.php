<?php

namespace App\Core\Implement;

use App\Core\Repositories\MenuRepository;
use App\Core\Models\Menu;

class MenuRepositoryImplement implements MenuRepository
{

    public function getAll()
    {
        return Menu::active()
            ->with('module')
            ->orderBy('order_no')
            ->get();
    }

    public function find($id)
    {
        return Menu::findOrFail($id);
    }

    public function getByModule($moduleId)
    {
        return Menu::active()
            ->where('module_id', $moduleId)
            ->orderBy('order_no')
            ->get();
    }

    public function store(array $data)
    {
        return Menu::create($data);
    }

    public function update($id, array $data)
    {
        $menu = Menu::findOrFail($id);
        $menu->update($data);

        return $menu;
    }

    public function delete($id)
    {
        return Menu::destroy($id);
    }
}