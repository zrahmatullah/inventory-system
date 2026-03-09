<?php

namespace App\Implement;

use App\Repositories\UserMenuRepository;
use App\Models\UserMenu;

class UserMenuRepositoryImplement implements UserMenuRepository
{

    public function getAll()
    {
        return UserMenu::with(['user','menu'])->get();
    }

    public function getByUser($userId)
    {
        return UserMenu::active()
            ->where('user_id',$userId)
            ->with('menu')
            ->get();
    }

    public function find($id)
    {
        return UserMenu::findOrFail($id);
    }

    public function store(array $data)
    {
        return UserMenu::create($data);
    }

    public function update($id, array $data)
    {
        $dataMenu = UserMenu::findOrFail($id);
        $dataMenu->update($data);

        return $dataMenu;
    }

    public function delete($id)
    {
        return UserMenu::destroy($id);
    }
}