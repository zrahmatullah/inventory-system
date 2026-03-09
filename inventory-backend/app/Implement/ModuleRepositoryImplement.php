<?php

namespace App\Implement;

use App\Repositories\ModuleRepository;
use App\Models\Module;

class ModuleRepositoryImplement implements ModuleRepository
{

    public function getAll()
    {
        return Module::orderBy('order_no')->get();
    }

    public function find($id)
    {
        return Module::findOrFail($id);
    }

    public function store(array $data)
    {
        return Module::create($data);
    }

    public function update($id, array $data)
    {
        $module = Module::findOrFail($id);
        $module->update($data);

        return $module;
    }

    public function delete($id)
    {
        return Module::destroy($id);
    }
}